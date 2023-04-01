window.addEventListener("load", function () {
    document.getElementById("addPayment").addEventListener("click", clearInputFields)
    document.getElementById("add-payment").addEventListener("click", sendPaymentToDB)

    getSuppliers()
    getPayments()
})

function clearInputFields() {
    document.getElementById("payment-method").value = ''
    document.getElementById("cheque-number").value = ''
    document.getElementById("amount").value = ''
    document.getElementById("paid-date").value = ''
    document.getElementById("inputGroupSelect01").value = ''
}

async function sendPaymentToDB() {
    let paymentMethod = document.getElementById("payment-method").value
    let chequeNo = document.getElementById("cheque-number").value
    let amount = document.getElementById("amount").value
    let paidDate = document.getElementById("paid-date").value
    let paidTo = document.getElementById("inputGroupSelect01").value

    if (paymentMethod === "" || amount === "" || paidDate === "" || paidTo === "") {
        alert("Fill all fields")
    } else {
        let response = await sendJsonRequest("/dashboard/payments", {
            action: "add-payment",
            payload: {
                "payment-method": paymentMethod,
                "cheque-number": chequeNo,
                "amount": amount,
                "paid-date": paidDate,
                "paid-to-id": paidTo
            }
        })
        if (response.status === 200) {
            let data = await response.json()
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

function clearTable(){
    let paymentTable = document.getElementById("paymentTable")
    paymentTable.innerHTML = ""
}

async function addItemToTable(paymentId, paymentMethod, chequeNo, amount, paidDate, paidTo) {
    let paymentTable = document.getElementById("paymentTable")

    let newRow = paymentTable.insertRow(-1)

    newRow.insertCell(0).innerText = paymentId
    newRow.insertCell(1).innerText = paymentMethod
    newRow.insertCell(2).innerText = chequeNo
    newRow.insertCell(3).innerText = amount
    newRow.insertCell(4).innerText = paidDate
    newRow.insertCell(5).innerText = paidTo

}

async function getSupplierName(supplierId) {
    let response = await sendJsonRequest('/dashboard/suppliers', {
        'action': 'get-supplier-by-id',
        'payload': {
            'supplier-id': supplierId
        }
    })
    if (response.status === 200) {
        let data = await response.json()
        return data.body['supplier-name'];
    }
    return "Unknown"
}

async function getSuppliers(){
    let body = {
        'action': 'get-suppliers'
    }
    let response = await sendJsonRequest('/dashboard/suppliers', body)
    if (response.status === 200) {
        let data = await response.json()
        let selectionSuppliers = document.getElementById('inputGroupSelect01')
        for (let supplier of data.body.suppliers) {
            selectionSuppliers.innerHTML += `<option value="${supplier['id']}">${supplier['name']}</option>`
        }
    }
}

async function getPayments() {
    let response = await sendJsonRequest('/dashboard/payments', {'action': 'get-payments'})
    if (response.status === 200) {
        let data = await response.json()
        clearTable()
        for (const payment of data.body.payments) {
            addItemToTable(payment['id'], payment['method'], payment['cheque_number'], payment['amount'],
                payment['payment_date'], await getSupplierName(payment['supplier_id']))
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