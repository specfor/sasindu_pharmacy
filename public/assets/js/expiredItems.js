let productId
let typingTimer;
let doneTypingInterval = 500;
let suppliersArray

window.addEventListener('load', async () => {
    await getSuppliers();
    getExpiringItems();
    getExpiredItems();

    // Add filters
    // let productNameFilter = document.getElementById('productNameFilter')
    // let priceFilter = document.getElementById('priceFilter')
    // let supplierFilter = document.getElementById('suppliersFilter')
    // document.getElementById('btnClearFilterProductName').addEventListener('click', () => {
    //     productNameFilter.value = ''
    //     searchItems()
    // })
    // document.getElementById('btnClearFilterPrice').addEventListener('click', () => {
    //     priceFilter.value = ''
    //     searchItems()
    // })
    // document.getElementById('btnClearFilterSupplier').addEventListener('click', () => {
    //     supplierFilter.value = -1
    //     searchItems()
    // })
    // productNameFilter.addEventListener('keyup', () => {
    //     clearTimeout(typingTimer);
    //     typingTimer = setTimeout(searchItems, doneTypingInterval);
    //
    // });
    // priceFilter.addEventListener('keyup', () => {
    //     clearTimeout(typingTimer);
    //     typingTimer = setTimeout(searchItems, doneTypingInterval);
    //
    // });
    // supplierFilter.addEventListener('change', () => {
    //     searchItems()
    // });
})

function searchItems() {
    let productName = document.getElementById('productNameFilter').value
    let price = document.getElementById('priceFilter').value
    let supplierId = document.getElementById('suppliersFilter').value

    getExpiringItems(productName, price, supplierId)
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
    let response = await sendJsonRequest('/dashboard/suppliers', {
        'action': 'get-suppliers'
    })
    if (response.status === 200) {
        let suppliers = await response.json()
        suppliersArray = suppliers.body['suppliers']
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
        console.log(data)
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
        addPaginationButtons('Expiring',data.body['total-number-of-items'], data.body['active-page-index'])
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
        console.log(data)
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
        addPaginationButtons('Expired',data.body['total-number-of-items'], data.body['active-page-index'])
    }
}


function laodDataOfPage(tableName) {
    console.log(tableName)
    let pageNum = event.target.innerText
    if (tableName === 'expiring')
        getExpiringItems('', '', '', 20, pageNum)
    else
        getExpiredItems('', '', '', 20, pageNum)
}

function addPaginationButtons(tableName, totalItems, activePageIndex, itemsPerPage = 20) {
    let paginationHolder = document.getElementById('paginationButtons'+tableName)
    let numPages = Math.floor(totalItems / itemsPerPage)
    if (totalItems % itemsPerPage > 0)
        numPages += 1
    paginationHolder.innerHTML = ""

    for (let i = 1; i <= numPages; i++) {
        if (i == activePageIndex)
            paginationHolder.innerHTML += `<li class="page-item active"><a onclick="laodDataOfPage('${tableName}')" class="page-link" href="#">${i}</a></li>`
        else
            paginationHolder.innerHTML += `<li class="page-item"><a onclick="laodDataOfPage('${tableName}')" class="page-link" href="#">${i}</a></li>`
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