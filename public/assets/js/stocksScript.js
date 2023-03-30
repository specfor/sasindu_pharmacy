let clickedBtnId

window.addEventListener('load', () => {
    document.getElementById('btn-add-new-item').addEventListener('click', clearAddNewItemInputs)
    document.getElementById('btnAddItem').addEventListener('click', addItemToDatabase)
    document.getElementById('btnSaveChanges').addEventListener('click', updateItemToDatabase)

    getSuppliers();
    getItems();
})

function clearAddNewItemInputs() {
    document.getElementById('productName').value = ''
    document.getElementById('quantity').value = ''
    document.getElementById('buyingDate').value = ''
    document.getElementById('expDate').value = ''
    document.getElementById('supplierId').value = ''
    document.getElementById('price').value = ''
}

function clearTable() {
    let itemTable = document.getElementById("itemTable")
    itemTable.innerHTML = '';
}

async function addItemToTable(productId, productName, quantity, buyDate, expDate, supplierName, price) {
    let itemTable = document.getElementById("itemTable")

    let newRow = itemTable.insertRow(-1)

    newRow.insertCell(0).innerText = productId
    newRow.insertCell(1).innerText = productName
    newRow.insertCell(2).innerText = quantity
    newRow.insertCell(3).innerText = buyDate
    newRow.insertCell(4).innerText = expDate
    newRow.insertCell(5).innerText = supplierName
    newRow.insertCell(6).innerText = price
    newRow.insertCell(7).innerHTML = `<div class="input-group mb-3">
  <button onclick="editItem()" class="edit btn btn-primary fw-bold" type="button" id="btn-edit-${productId}" data-bs-toggle="modal" data-bs-target="#changeProductDetails">Edit Details</button>
  <button onclick="deleteItem()" class="delete btn btn-danger fw-bold" type="button" id="btn-delete-${productId}">Delete</button>
</div>`
}

async function editItem() {
    clickedBtnId = event.target.id.split('-')[2]
    let itemTable = document.getElementById("itemTable")

    for (let i = 0, row; row = itemTable.rows[i]; i++) {
        if (row.cells[0].innerText == clickedBtnId) {

            document.getElementById('newProductName').value = row.cells[1].innerText
            document.getElementById('newQuantity').value = row.cells[2].innerText
            document.getElementById('newBuyingDate').value = row.cells[3].innerText
            document.getElementById('newExpDate').value = row.cells[4].innerText
            document.getElementById('newSupplierId').value = await getSupplierId(row.cells[5].innerText)
            document.getElementById('newPrice').value = row.cells[6].innerText
        }
    }
}

function deleteItem() {
    clickedBtnId = event.target.id.split('-')[2]

}

async function addItemToDatabase() {
    let productName = document.getElementById('productName').value
    let quantity = document.getElementById('quantity').value
    let buyDate = document.getElementById('buyingDate').value
    let expDate = document.getElementById('expDate').value
    let supplierId = document.getElementById('supplierId').value
    let price = document.getElementById('price').value

    let response = await sendJsonRequest('/dashboard/stocks', {
        action: 'add-item',
        payload: {
            'product-name': productName,
            'product-amount': quantity,
            'buying-date': buyDate,
            'expire-date': expDate,
            'supplier-id': supplierId,
            'product-price': price
        }
    })
    if (response.status === 200) {
        let data = await response.json()
        if (data.statusMessage === 'success') {
            clearTable()
            getItems()
            alert(data.body.message)
            console.log(data.body.message)
        } else {
            alert(data.body.message)
            console.log(data.body.message)
        }
    }
}

async function updateItemToDatabase() {
    let productName = document.getElementById('newProductName').value
    let quantity = document.getElementById('newQuantity').value
    let buyDate = document.getElementById('newBuyingDate').value
    let expDate = document.getElementById('newExpDate').value
    let supplierId = document.getElementById('newSupplierId').value
    let price = document.getElementById('newPrice').value

    let response = await sendJsonRequest('/dashboard/stocks', {
        action: 'update-item',
        payload: {
            'product-id': clickedBtnId,
            'product-name': productName,
            'product-amount': quantity,
            'buying-date': buyDate,
            'expire-date': expDate,
            'supplier-id': supplierId,
            'product-price': price
        }
    })
    if (response.status === 200) {
        let data = await response.json()
        if (data.statusMessage === 'success') {
            let itemTable = document.getElementById("itemTable")
            for (let i = 0, row; row = itemTable.rows[i]; i++) {
                if (row.cells[0].innerText == clickedBtnId) {
                    row.cells[1].innerText = productName
                    row.cells[2].innerText = quantity
                    row.cells[3].innerText = buyDate
                    row.cells[4].innerText = expDate
                    row.cells[5].innerText = await getSupplierName(supplierId)
                    row.cells[6].innerText = price
                }
            }
            alert(data.body.message)
        } else {
            alert(data.body.message)
            console.log(data.body.message)
        }
    }
}

//  Return supplier name if success, false if request fails.
async function getSupplierName(supplierID) {
    let response = await sendJsonRequest('/dashboard/suppliers', {
        'action': 'get-supplier-by-id',
        'payload': {
            'supplier-id': supplierID
        }
    })
    if (response.status === 200) {
        let data = await response.json()
        return data.body['supplier-name']
    } else {
        return false
    }
}

async function getSupplierId(supplierName) {
    let response = await sendJsonRequest('/dashboard/suppliers', {
        'action': 'get-supplier-by-name',
        'payload': {
            'supplier-name': supplierName
        }
    })
    if (response.status === 200) {
        let data = await response.json()
        return data.body['supplier-id']
    } else {
        return false
    }

}

async function getSuppliers() {
    let selectionSuppliers = document.getElementById('supplierId')
    let selectionSuppliersUpdate = document.getElementById('newSupplierId')

    let response = await sendJsonRequest('/dashboard/suppliers', {
        'action': 'get-suppliers'
    })
    if (response.status === 200) {
        let suppliers = await response.json()
        for (const supplier of suppliers.body['suppliers']) {
            selectionSuppliers.innerHTML += `<option value="${supplier['id']}">${supplier['name']}</option>`
            selectionSuppliersUpdate.innerHTML += `<option value="${supplier['id']}">${supplier['name']}</option>`
        }
    }
}

async function getItems(filterProductName, filterProductPrice, filterSupplierId, limitResults, resultsBeginIndex) {
    let body = {
        'action': 'get-items'
    }
    if (filterProductName) {
        body['payload']['filters']['product-name'] = filterProductName
    }
    if (filterProductPrice) {
        body['payload']['filters']['price'] = filterProductPrice
    }
    if (filterSupplierId) {
        body['payload']['filters']['supplier-id'] = filterSupplierId
    }
    if (limitResults) {
        body['payload']['filters']['limit'] = limitResults
    }
    if (resultsBeginIndex) {
        body['payload']['filters']['limit'] = resultsBeginIndex
    }

    let response = await sendJsonRequest('/dashboard/stocks', body)
    if (response.status === 200) {
        let data = await response.json()
        for (let row of data.body.items) {
            let supplierName = await getSupplierName(row['supplier_id'])
            await addItemToTable(row['id'], row['name'], row['quantity'], row['buy_date'], row['exp_date'],
                supplierName, row['retail_price'])
        }
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

