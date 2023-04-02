let productId
let typingTimer;
let doneTypingInterval = 500;
let suppliersArray

window.addEventListener('load', async () => {
    await getSuppliers();
    getExpiringItems();
    getExpiredItems();

    // Add filters
    let expiringProductNameFilter = document.getElementById('expiringProductNameFilter')
    let expiringPriceFilter = document.getElementById('expiringPriceFilter')
    let expiringSupplierFilter = document.getElementById('expiringSuppliersFilter')
    let expiredProductNameFilter = document.getElementById('expiredProductNameFilter')
    let expiredPriceFilter = document.getElementById('expiredPriceFilter')
    let expiredSupplierFilter = document.getElementById('expiredSuppliersFilter')
    document.getElementById('btnClearFilterProductNameExpiring').addEventListener('click', () => {
        expiringProductNameFilter.value = ''
        searchItems('expiring')
    })
    document.getElementById('btnClearFilterPriceExpiring').addEventListener('click', () => {
        expiringPriceFilter.value = ''
        searchItems('expiring')
    })
    document.getElementById('btnClearFilterSupplierExpiring').addEventListener('click', () => {
        expiringSupplierFilter.value = -1
        searchItems('expiring')
    })
    document.getElementById('btnClearFilterProductNameExpired').addEventListener('click', () => {
        expiredProductNameFilter.value = ''
        searchItems('expired')
    })
    document.getElementById('btnClearFilterPriceExpired').addEventListener('click', () => {
        expiredPriceFilter.value = ''
        searchItems('expired')
    })
    document.getElementById('btnClearFilterSupplierExpired').addEventListener('click', () => {
        expiredSupplierFilter.value = -1
        searchItems('expired')
    })
    expiringProductNameFilter.addEventListener('keyup', () => {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(() => {
            searchItems('expiring')
        }, doneTypingInterval);

    });
    expiringPriceFilter.addEventListener('keyup', () => {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(() => {
            searchItems('expiring')
        }, doneTypingInterval);
    });
    expiringPriceFilter.addEventListener('change', ()=>{
        if (expiringPriceFilter.value < 0){
            expiringPriceFilter.value =""
        }
    })
    expiredPriceFilter.addEventListener('change', ()=>{
        if (expiredPriceFilter.value < 0){
            expiredPriceFilter.value =""
        }
    })
    expiringSupplierFilter.addEventListener('change', () => {
        searchItems('expiring')
    });
    expiredProductNameFilter.addEventListener('keyup', () => {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(() => {
            searchItems('expired')
        }, doneTypingInterval);

    });
    expiredPriceFilter.addEventListener('keyup', () => {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(() => {
            searchItems('expired')
        }, doneTypingInterval);

    });
    expiredSupplierFilter.addEventListener('change', () => {
        searchItems('expired')
    });
})

function searchItems(tableName) {
    let productName = document.getElementById(tableName + 'ProductNameFilter').value
    let price = document.getElementById(tableName + 'PriceFilter').value
    let supplierId = document.getElementById(tableName + 'SuppliersFilter').value

    if (tableName === "expiring")
        getExpiringItems(productName, price, supplierId)
    else
        getExpiredItems(productName, price, supplierId)
}

function clearTable(tableName) {
    let itemTable = document.getElementById(tableName + "ItemTable")
    itemTable.innerHTML = '';
}

async function addItemToTable(tableName, productName, quantity, buyDate, expDate, supplierName, price) {
    let itemTable = document.getElementById(tableName + "ItemTable")

    let newRow = itemTable.insertRow(-1)

    newRow.insertCell(0).innerText = productName
    newRow.insertCell(1).innerText = quantity
    newRow.insertCell(2).innerText = buyDate
    newRow.insertCell(3).innerText = expDate
    newRow.insertCell(4).innerText = supplierName
    newRow.insertCell(5).innerText = price
}

async function getSuppliers() {
    let selectionSuppliersExpiring = document.getElementById('expiringSuppliersFilter')
    let selectionSuppliersExpired = document.getElementById('expiredSuppliersFilter')


    let response = await sendJsonRequest('/dashboard/suppliers', {
        'action': 'get-suppliers'
    })
    if (response.status === 200) {
        let suppliers = await response.json()
        suppliersArray = suppliers.body['suppliers']
        for (const supplier of suppliers.body['suppliers']) {
            selectionSuppliersExpiring.innerHTML += `<option value="${supplier['id']}">${supplier['name']}</option>`
            selectionSuppliersExpired.innerHTML += `<option value="${supplier['id']}">${supplier['name']}</option>`
        }
    }
}

async function getExpiringItems(filterProductName, filterProductPrice, filterSupplierId, limitResults = 20, pageNum = 1) {
    let body = {
        'action': 'get-expiring-soon',
        'payload': {
            'filters': {}
        }
    }
    if (filterProductName) {
        body['payload']['filters']['product-name'] = filterProductName
    }
    if (filterProductPrice) {
        body['payload']['filters']['price'] = filterProductPrice
    }
    if (filterSupplierId > 0) {
        body['payload']['filters']['supplier-id'] = filterSupplierId
    }
    if (limitResults) {
        body['payload']['filters']['limit'] = limitResults
    }
    if (pageNum != 1) {
        body['payload']['filters']['begin'] = (pageNum - 1) * limitResults
    }

    let response = await sendJsonRequest('/dashboard/expired', body)
    if (response.status === 200) {
        let data = await response.json()
        clearTable('expiring')
        for (let row of data.body.items) {
            let supplierName = 'Unknown'
            for (const supplier of suppliersArray) {
                if (supplier['id'] == row['supplier_id']) {
                    supplierName = supplier['name']
                }
            }
            await addItemToTable('expiring', row['name'], row['quantity'], row['buy_date'], row['exp_date'],
                supplierName, row['retail_price'])
        }
        addPaginationButtons('Expiring', data.body['total-number-of-items'], data.body['active-page-index'])
    }
}


async function getExpiredItems(filterProductName, filterProductPrice, filterSupplierId, limitResults = 20, pageNum = 1) {
    let body = {
        'action': 'get-expired',
        'payload': {
            'filters': {}
        }
    }
    if (filterProductName) {
        body['payload']['filters']['product-name'] = filterProductName
    }
    if (filterProductPrice) {
        body['payload']['filters']['price'] = filterProductPrice
    }
    if (filterSupplierId > 0) {
        body['payload']['filters']['supplier-id'] = filterSupplierId
    }
    if (limitResults) {
        body['payload']['filters']['limit'] = limitResults
    }
    if (pageNum != 1) {
        body['payload']['filters']['begin'] = (pageNum - 1) * limitResults
    }

    let response = await sendJsonRequest('/dashboard/expired', body)
    if (response.status === 200) {
        let data = await response.json()
        clearTable('expired')
        for (let row of data.body.items) {
            let supplierName = 'Unknown'
            for (const supplier of suppliersArray) {
                if (supplier['id'] == row['supplier_id']) {
                    supplierName = supplier['name']
                }
            }
            await addItemToTable('expired', row['name'], row['quantity'], row['buy_date'], row['exp_date'],
                supplierName, row['retail_price'])
        }
        addPaginationButtons('Expired', data.body['total-number-of-items'], data.body['active-page-index'])
    }
}


function laodDataOfPage(tableName) {
    let pageNum = event.target.innerText
    if (tableName === 'Expiring')
        getExpiringItems('', '', '', 20, pageNum)
    else
        getExpiredItems('', '', '', 20, pageNum)
}

function addPaginationButtons(tableName, totalItems, activePageIndex, itemsPerPage = 20) {
    let paginationHolder = document.getElementById('paginationButtons' + tableName)
    let numPages = Math.floor(totalItems / itemsPerPage)
    if (totalItems % itemsPerPage > 0)
        numPages += 1
    paginationHolder.innerHTML = ""

    for (let i = 1; i <= numPages; i++) {
        if (i == activePageIndex)
            paginationHolder.innerHTML += `<li class="page-item active"><a onclick="laodDataOfPage('${tableName}')" class="page-link" href="#${tableName}Items">${i}</a></li>`
        else
            paginationHolder.innerHTML += `<li class="page-item"><a onclick="laodDataOfPage('${tableName}')" class="page-link" href="#${tableName}Items">${i}</a></li>`
    }
}

// Returns the fetch response object
async function sendJsonRequest(url, jsonBody) {
    return await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(jsonBody),
        credentials: "same-origin"
    })
}