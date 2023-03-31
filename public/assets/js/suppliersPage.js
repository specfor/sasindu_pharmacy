let supplierId
let typingTimer;
let doneTypingInterval = 500;

window.addEventListener("load",function(){
    document.getElementById("btn-add-new").addEventListener("click",clearAllInputFields)
    document.getElementById("addSupplier").addEventListener("click",addSupplierToTheDB)
    document.getElementById('btnConfirmDeletion').addEventListener('click',deleteSupplier)
    document.getElementById('update').addEventListener('click',updateSupplierToDatabase)

    getSuppliers()

    // Add filters
    let supplierNameFilter = document.getElementById('filterSupplierName')
    let contactNumberFilter = document.getElementById('filterContactNumber')
    let medicalRefFilter = document.getElementById('filterMedicalRef')
    document.getElementById('btnClearFilterSupplierName').addEventListener('click', () => {
        supplierNameFilter.value = ''
        searchItems()
    })
    document.getElementById('btnClearFilterContactNumber').addEventListener('click', () => {
        contactNumberFilter.value = ''
        searchItems()
    })
    document.getElementById('btnClearFilterMedicalRef').addEventListener('click', () => {
        medicalRefFilter.value = ''
        searchItems()
    })
    supplierNameFilter.addEventListener('keyup', () => {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(searchItems, doneTypingInterval);

    });
    contactNumberFilter.addEventListener('keyup', () => {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(searchItems, doneTypingInterval);

    });
    medicalRefFilter.addEventListener('keyup', () => {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(searchItems, doneTypingInterval);
    });
})

function searchItems() {
    let supplierName = document.getElementById('filterSupplierName').value
    let contactNum = document.getElementById('filterContactNumber').value
    let medicalRef = document.getElementById('filterMedicalRef').value

    getSuppliers(supplierName, contactNum, medicalRef)
}

async function getSuppliers(filterSupplierName, filterContactNumber, filterMedicalRef) {
    let body = {
        'action': 'get-suppliers',
        'payload': {
            'filters': {}
        }
    }
    if (filterSupplierName) {
        body['payload']['filters']['supplier-name'] = filterSupplierName
    }
    if (filterContactNumber) {
        body['payload']['filters']['contact-number'] = filterContactNumber
    }
    if (filterMedicalRef){
        body['payload']['filters']['medical-ref'] = filterMedicalRef
    }

    let response = await sendJsonRequest('/dashboard/suppliers', body)
    if (response.status === 200) {
        let data = await response.json()
        clearTable()
        for (let row of data.body.suppliers) {
            await insertToSupplierTable(row['id'], row['name'], row['medical_ref'], row['contact_number'])
        }
    }
}

//This function clears all add new company input fields every time clicked the button
function clearAllInputFields(){
    document.getElementById("supplierName").value = ""
    document.getElementById("medRef").value = ""
    document.getElementById("contactNumber").value = ""
}

async function editSupplier() {
    supplierId = event.target.id.split('-')[2]
    let supplierTable = document.getElementById("supplierTable")

    for (let i = 0, row; row = supplierTable.rows[i]; i++) {
        if (row.cells[0].innerText == supplierId) {
            document.getElementById('newSupplierName').value = row.cells[1].innerText
            document.getElementById('newMedRef').value = row.cells[2].innerText
            document.getElementById('newContactNum').value = row.cells[3].innerText
        }
    }
}

//This function sends data to the database
async function addSupplierToTheDB(){
    let supplierName = document.getElementById("supplierName").value
    let medRef  =  document.getElementById("medRef").value
    let contactNumber = document.getElementById("contactNumber").value

    let response = await sendJsonRequest('/dashboard/suppliers', {
        action: 'add-supplier',
        payload: {
            'supplier-name': supplierName,
            'medical-ref': medRef,
            'contact-number': contactNumber,
        }
    })
    
    if (response.status === 200) {
        let data = await response.json()
      
        if (data.statusMessage === 'success') {
            getSuppliers()
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
async function insertToSupplierTable(companyId,companyName,medRef,contactNumber){
    let supplierTable = document.getElementById("supplierTable")

    let newRow = supplierTable.insertRow(-1)

    newRow.insertCell(0).innerText = companyId
    newRow.insertCell(1).innerText = companyName
    newRow.insertCell(2).innerText = medRef
    newRow.insertCell(3).innerText = contactNumber
    newRow.insertCell(4).innerHTML = `<div class="input-group mb-3">
    <button onclick="editSupplier()" class="edit btn btn-primary fw-bold" type="button" id="btn-edit-${companyId}" data-bs-toggle="modal" data-bs-target="#editSupplierDetails">Edit Details</button>
    <button onclick="showDeleteConfirmation()" class="delete btn btn-danger fw-bold" type="button" id="btn-delete-${companyId}">Delete</button>
  </div>`
}


function showDeleteConfirmation(){
    supplierId = event.target.id.split('-')[2]

    let modalElement = document.getElementById('confirmDelete')
    let modal = new bootstrap.Modal(modalElement)
    modal.show()
}

async function deleteSupplier() {
    let response = await sendJsonRequest('/dashboard/suppliers', {
        'action': 'remove-supplier',
        'payload': {
            'supplier-id': supplierId
        }
    })
    if (response.status === 200) {
        let data = await response.json()
        if (data.statusMessage === 'success') {
            let supplierTable = document.getElementById("supplierTable")

            for (let i = 0, row; row = supplierTable.rows[i]; i++) {
                if (row.cells[0].innerText == supplierId) {
                    supplierTable.deleteRow(i)
                }
            }
            alert(data.body.message)
        } else {
            alert(data.body.message)
        }
    }
}


function clearTable() {
    let supplierTable = document.getElementById("supplierTable")
    supplierTable.innerHTML = '';
}

async function updateSupplierToDatabase() {
    let companyName = document.getElementById('newSupplierName').value
    let medRef = document.getElementById('newMedRef').value
    let contactNum = document.getElementById('newContactNum').value

    let response = await sendJsonRequest('/dashboard/suppliers', {
        action: 'update-supplier',
        payload: {
            'supplier-id': supplierId,
            'supplier-name': companyName,
            'medical-ref': medRef,
            'contact-number': contactNum,
        }
    })
    if (response.status === 200) {
        let data = await response.json()
        if (data.statusMessage === 'success') {
            let supplierTable = document.getElementById("supplierTable")
            for (let i = 0, row; row = supplierTable.rows[i]; i++) {
                if (row.cells[0].innerText == supplierId) {
                    row.cells[1].innerText = companyName
                    row.cells[2].innerText = medRef
                    row.cells[3].innerText = contactNum
                }
            }
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
