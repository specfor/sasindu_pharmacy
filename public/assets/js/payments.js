window.addEventListener("load",function(){
    document.getElementById("addPayment").addEventListener("click",clearInputFields)
    document.getElementById("add-payment").addEventListener("click",sendDataToDB)

})

function clearInputFields(){
    document.getElementById("payment-method").value = ''
    document.getElementById("cheque-number").value = ''
    document.getElementById("amount").value = ''
    document.getElementById("paid-date").value = ''
    document.getElementById("inputGroupSelect01").value = ''
}

async function sendDataToDB(){
   let paymentMethod = document.getElementById("payment-method").value 
   let chequeNo =  document.getElementById("cheque-number").value 
   let amount = document.getElementById("amount").value
   let paidDate = document.getElementById("paid-date").value 
   let paidTo = document.getElementById("inputGroupSelect01").value 

    if(paymentMethod===""||chequeNo===""||amount===""||paidDate===""||paidTo===""){
        alert("Fill all fields")
    }else{

        let response = await sendJsonRequest("/dashboard/payments",{
            action:"get-payments",
            payload:{
                "payment-method":paymentMethod,
                "cheque-number":chequeNo,
                "amount":amount,
                "payment-date":paidDate,
                "supplier-id":paidTo
            }           
        })
        if (response.status === 200) {
            let data = await response.json()
            if (data.statusMessage === 'success') {
                clearInputFields()
                //Update the table
                
                alert(data.body.message)
            } else {
                alert(data.body.message)
            }
        }
        
    }
}


async function addItemToTable(paymentId, paymentMethod, chequeNo, amount, paidDate,paidTo) {
    let paymentTable = document.getElementById("paymentTable")

    let newRow = paymentTable.insertRow(-1)

    newRow.insertCell(0).innerText = paymentId
    newRow.insertCell(1).innerText = paymentMethod
    newRow.insertCell(2).innerText = chequeNo
    newRow.insertCell(3).innerText = amount
    newRow.insertCell(4).innerText = paidDate
    newRow.insertCell(5).innerText = paidTo
 
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