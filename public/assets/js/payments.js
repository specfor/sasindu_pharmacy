let suppliersArray = []

window.addEventListener("load", async function () {
    document.getElementById("addPayment").addEventListener("click", clearInputFields)
    document.getElementById("add-payment").addEventListener("click", sendPaymentToDB)

    await getSuppliers()
    getPayments()

    // Add filters
    let BankFilter = document.getElementById('bankFilter')
    let PaymentMethodFilter = document.getElementById('paymentMethodFilter')
    let supplierFilter = document.getElementById('paidToFilter')
    let dateFilter = document.getElementById('paid-dateFilter')
    document.getElementById('btnClearFilterBank').addEventListener('click', () => {
        BankFilter.value = '-1'
        searchItems()
    })
    document.getElementById('btnClearFilterPaymentMethod').addEventListener('click', () => {
        PaymentMethodFilter.value = '-1'
        searchItems()
    })
    document.getElementById('btnClearFilterSupplier').addEventListener('click', () => {
        supplierFilter.value = "-1"
        searchItems()
    })
    document.getElementById('btnClearFilterPaidDate').addEventListener('click', () => {
        dateFilter.value = ""
        searchItems()
    })
    BankFilter.addEventListener('change', () => {
        searchItems()
    });
    PaymentMethodFilter.addEventListener('change', () => {
        searchItems()
    });
    supplierFilter.addEventListener('change', ()=>{
        searchItems()
    })
    dateFilter.addEventListener('change', () => {
        searchItems()
    });
})

function searchItems() {
    let bank = document.getElementById('bankFilter').value
    let method = document.getElementById('paymentMethodFilter').value
    let supplierId = document.getElementById('paidToFilter').value
    let paidDate = document.getElementById('paid-dateFilter').value

    getPayments(20, 1, bank, method, supplierId, paidDate)
}

function clearInputFields() {
    document.getElementById("payment-method").value = ''
    document.getElementById("cheque-number").value = ''
    document.getElementById("amount").value = ''
    document.getElementById("paid-date").value = ''
    document.getElementById("inputGroupSelect01").value = ''
    document.getElementById("bankSelection").value = ''
}

async function sendPaymentToDB() {
    let paymentMethod = document.getElementById("payment-method").value
    let chequeNo = document.getElementById("cheque-number").value
    let amount = document.getElementById("amount").value
    let paidDate = document.getElementById("paid-date").value
    let paidTo = document.getElementById("inputGroupSelect01").value
    let bankName = document.getElementById('bankSelection').value

    if (paymentMethod === "" || amount === "" || paidDate === "" || paidTo === "") {
        alert("Fill all fields")
    } else {
        let response = await sendJsonRequest("/dashboard/payments", {
            action: "add-payment",
            payload: {
                "payment-method": paymentMethod,
                "cheque-number": chequeNo,
                "bank-name": bankName,
                "amount": amount,
                "paid-date": paidDate,
                "paid-to-id": paidTo
            }
        })
        if (response.status === 200) {
            let data = await response.json()
            console.log(data)
            if (data.statusMessage === 'success') {
                clearInputFields()
                //Update the table
                getPayments()
                alert(data.body.message)
            } else {
                alert(data.body.message)
            }
        }

    }
}

function clearTable() {
    let paymentTable = document.getElementById("paymentTable")
    paymentTable.innerHTML = ""
}

async function addItemToTable(paymentId, paymentMethod, chequeNo, bankName, amount, paidDate, paidTo) {
    let paymentTable = document.getElementById("paymentTable")

    let newRow = paymentTable.insertRow(-1)

    newRow.insertCell(0).innerText = paymentId
    newRow.insertCell(1).innerText = paymentMethod
    newRow.insertCell(2).innerText = chequeNo
    newRow.insertCell(3).innerText = bankName
    newRow.insertCell(4).innerText = amount
    newRow.insertCell(5).innerText = paidDate
    newRow.insertCell(6).innerText = paidTo

}

function getSupplierName(supplierId) {
    for (const supplier of suppliersArray) {
        if (supplier['id'] == supplierId)
            return supplier['name']
    }
}

function laodDataOfPage() {
    let pageNum = event.target.innerText
    getPayments(20, pageNum)
}

function addPaginationButtons(totalItems, activePageIndex, itemsPerPage = 20) {
    let paginationHolder = document.getElementById('paginationButtons')
    let numPages = Math.floor(totalItems / itemsPerPage)
    if (totalItems % itemsPerPage > 0)
        numPages += 1
    paginationHolder.innerHTML = ""
    for (let i = 1; i <= numPages; i++) {
        if (i == activePageIndex)
            paginationHolder.innerHTML += `<li class="page-item active"><a onclick="laodDataOfPage()" class="page-link" href="#">${i}</a></li>`
        else
            paginationHolder.innerHTML += `<li class="page-item"><a onclick="laodDataOfPage()" class="page-link" href="#">${i}</a></li>`
    }
}

async function getSuppliers() {
    let body = {
        'action': 'get-suppliers'
    }
    let response = await sendJsonRequest('/dashboard/suppliers', body)
    if (response.status === 200) {
        let data = await response.json()
        suppliersArray = data.body.suppliers
        let selectionSuppliers = document.getElementById('inputGroupSelect01')
        let selectionSuppliersFilter = document.getElementById('paidToFilter')
        for (let supplier of data.body.suppliers) {
            selectionSuppliers.innerHTML += `<option value="${supplier['id']}">${supplier['name']}</option>`
            selectionSuppliersFilter.innerHTML += `<option value="${supplier['id']}">${supplier['name']}</option>`
        }
    }
}

async function getPayments(limitResults = 20, pageNum = 1, bankName = '',
                           method = '', supplierId = -1, paidDate = '') {
    let body = {
        'action': 'get-payments',
        'payload': {
            "filters": {}
        }
    }
    if (bankName != -1)
        body['payload']['filters']['bank-name'] = bankName
    if (method != -1)
        body['payload']['filters']['method'] = method
    if (supplierId > 0)
        body['payload']['filters']['paid-to-id'] = supplierId
    if (paidDate)
        body['payload']['filters']['paid-date'] = paidDate

    body['payload']['filters']['limit'] = limitResults
    body['payload']['filters']['begin'] = (pageNum - 1) * limitResults
    let response = await sendJsonRequest('/dashboard/payments', body)
    if (response.status === 200) {
        let data = await response.json()
        clearTable()
        for (const payment of data.body.payments) {
            addItemToTable(payment['id'], payment['method'], payment['cheque_number'], payment['bank'], payment['amount'],
                payment['payment_date'], getSupplierName(payment['supplier_id']))
        }
        addPaginationButtons(data.body['total-number-of-items'], data.body['active-page-index'])
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