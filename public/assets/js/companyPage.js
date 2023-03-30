let companyId

window.addEventListener("load",function(){
    document.getElementById("btn-add-new").addEventListener("click",clearAllInputFields)
    document.getElementById("addCompany").addEventListener("click",sendDataToTheDB)
    document.getElementById('btnConfirmDeletion').addEventListener('click',deleteItem)
    document.getElementById('update').addEventListener('click',updateItemToDatabase)
})



//This function clears all add new company input fields every time clicked the button
function clearAllInputFields(){
    document.getElementById("companyName").value = ""
    document.getElementById("medRef").value = "" 
    document.getElementById("contactNumber").value = ""
    document.getElementById("password").value = ""
}


async function editCompany() {
    companyId = event.target.id.split('-')[2]
    let companyTable = document.getElementById("companyTable")

    for (let i = 0, row; row = companyTable.rows[i]; i++) {
        if (row.cells[0].innerText == companyId) {

            document.getElementById('newCompanyName').value = row.cells[1].innerText
            document.getElementById('newMedRef').value = row.cells[2].innerText
            document.getElementById('newContactNum').value = row.cells[3].innerText
        }
    }
}

//This function sends data to the database
async function sendDataToTheDB(){
    let companyName = document.getElementById("companyName").value
    let medRef  =  document.getElementById("medRef").value
    let contactNumber = document.getElementById("contactNumber").value

    let response = await sendJsonRequest('/dashboard/suppliers', {
        action: 'add-supplier',
        payload: {
            'supplier-name': companyName,
            'medical-ref': medRef,
            'contact-number': contactNumber,
        }
    })
    
    if (response.status === 200) {
        let data = await response.json()
      
        if (data.statusMessage === 'success') {
            clearAllInputFields()
            alert(data.body.message)
            console.log(data.body.message)
        } else {
            alert(data.body.message)
            console.log(data.body.message)
        }
    }
}

//This function updates the company table
async function updateTheCompanyTable(companyId,companyName,medRef,contactNumber){
    let companyTable = document.getElementById("companyTable")

    let newRow = companyTable.insertRow(-1)

    newRow.insertCell(0).innerText = companyId
    newRow.insertCell(1).innerText = companyName
    newRow.insertCell(2).innerText = medRef
    newRow.insertCell(3).innerText = contactNumber
    newRow.insertCell(4).innerText = `<div class="input-group mb-3">
    <button onclick="editItem()" class="edit btn btn-primary fw-bold" type="button" id="btn-edit-${companyId}" data-bs-toggle="modal" data-bs-target="#changeProductDetails">Edit Details</button>
    <button onclick="showDeleteConfirmation()" class="delete btn btn-danger fw-bold" type="button" id="btn-delete-${companyId}">Delete</button>
  </div>`


}

function showDeleteConfirmation(){
    companyId = event.target.id.split('-')[2]

    let modalElement = document.getElementById('confirmDelete')
    let modal = new bootstrap.Modal(modalElement)
    modal.show()
}

async function deleteItem() {
    let response = await sendJsonRequest('/dashboard/suppliers', {
        'action': 'delete-supplier',
        'payload': {
            'company-id': companyId
        }
    })
    if (response.status === 200) {
        let data = await response.json()
        if (data.statusMessage === 'success') {
            let itemTable = document.getElementById("companyTable")

            for (let i = 0, row; row = itemTable.rows[i]; i++) {
                if (row.cells[0].innerText == productId) {
                    itemTable.deleteRow(i)
                }
            }
            alert(data.body.message)
        } else {
            alert(data.body.message)
        }
    }
}


function clearTable() {
    let companyTable = document.getElementById("companyTable")
    companyTable.innerHTML = '';
}

async function updateItemToDatabase() {
    let companyName = document.getElementById('newCompanyName').value
    let medRef = document.getElementById('newMedRef').value
    let contactNum = document.getElementById('newContactNum').value

    let response = await sendJsonRequest('/dashboard/suppliers', {
        action: 'update-supplier',
        payload: {
            'company-id': companyId,
            'company-name': companyName,
            'medical-referance': medRef,
            'contact-number': contactNum,
        }
    })
    if (response.status === 200) {
        let data = await response.json()
        if (data.statusMessage === 'success') {
            let itemTable = document.getElementById("companyTable")
            for (let i = 0, row; row = itemTable.rows[i]; i++) {
                if (row.cells[0].innerText == companyId) {
                    row.cells[1].innerText = companyName
                    row.cells[2].innerText = medRef
                    row.cells[3].innerText = contactNum
                }
            }
            let modalElement = document.getElementById('editCompanyDetails')
            let modal = new bootstrap.Modal(modalElement)
            modal.hide()
            alert(data.body.message)

        } else {
            alert(data.body.message)
            console.log(data.body.message)
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
