let userId
let userRoles

window.addEventListener("load", function () {
    document.getElementById("addNewUser").addEventListener("click", clearAllInputs)
    document.getElementById("addUser").addEventListener("click", sendUserData2DB)
    document.getElementById('update').addEventListener('click', updateUserToDatabase)
    document.getElementById('changePass').addEventListener('click', changePass)
    document.getElementById('btnConfirmDeletion').addEventListener('click', deleteUser)

    getUserData()
    getUserRoles()
})

async function addUserToTable(userId, username, email, firstname, lastname, userRole) {
    let userTable = document.getElementById("userTable")

    let newRow = userTable.insertRow(-1)

    newRow.insertCell(0).innerText = userId
    newRow.insertCell(1).innerText = username
    newRow.insertCell(2).innerText = email
    newRow.insertCell(3).innerText = firstname
    newRow.insertCell(4).innerText = lastname
    newRow.insertCell(5).innerText = userRole
    newRow.insertCell(6).innerHTML = `<div class="input-group mb-3">
  <button onclick="editUser()" class="edit btn btn-primary fw-bold" type="button" id="btn-edit-${userId}" data-bs-toggle="modal" data-bs-target="#editUserModal">Edit User</button>
  <button onclick="prepareChangePass()" class="edit btn btn-primary fw-bold" type="button" id="btn-edit-${userId}" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change User Password</button>
  <button onclick="prepareDeleteUser()" class="delete btn btn-danger fw-bold" type="button" id="btn-delete-${userId}" data-bs-toggle="modal" data-bs-target="#confirmDelete">Delete</button>
</div>`
}

function prepareChangePass() {
    userId = event.target.id.split('-')[2]
}

function prepareDeleteUser() {
    userId = event.target.id.split('-')[2]
}

async function deleteUser() {
    reqBody = {
        'action': 'remove-user',
        'payload': {
            'user-id': userId
        }
    }
    let response = await sendJsonRequest('/dashboard/users', reqBody)
    if (response.status === 200){
        let data = await response.json()
        if (data.statusMessage === 'success'){
            let userTable = document.getElementById('userTable')

            for (let i = 0, row; row = userTable.rows[i]; i++) {
                if (row.cells[0].innerText == userId) {
                    userTable.deleteRow(i)
                }
            }
        }
        alert(data.body.message)
    }
}

function clearAllInputs() {
    document.getElementById("username").value = ''
    document.getElementById("email").value = ''
    document.getElementById("firstName").value = ''
    document.getElementById("password").value = ''
    document.getElementById("lastName").value = ''
}

async function sendUserData2DB() {
    let username = document.getElementById("username").value
    let email = document.getElementById("email").value
    let fName = document.getElementById("firstName").value
    let lName = document.getElementById("lastName").value
    let password = document.getElementById("password").value
    let userRole = document.getElementById("selectionUserRoles1")

    let role = userRole.options[userRole.selectedIndex].value

    if (!username || !fName || !lName || !password || !role){
        alert("Fill all required fields.")
        return
    }

    let response = await sendJsonRequest('/dashboard/users', {
        action: 'add-user',
        payload: {
            username: username,
            password: password,
            role: Number(role),
            firstname: fName,
            lastname: lName,
            email: email,
            dev: true,
        }
    })
    if (response.status === 200) {
        let data = await response.json()
        if (data.statusMessage === 'success') {
            clearAllInputs()
            //call the func to update the table here
            getUserData()

            alert(data.body.message)
        } else {
            alert(data.body.message)
        }
    }
}

async function changePass() {
    let newPass = document.getElementById("newUserPassword").value
    let newPassConfirm = document.getElementById("newUserPasswordConfirm").value

    if (newPass === newPassConfirm) {
        let response = await sendJsonRequest('/dashboard/users', {
            action: 'update-user-password',
            payload: {
                "user-id": userId,
                "password": newPass
            }
        })
        if (response.status === 200) {
            let data = await response.json()
            if (data.statusMessage === 'success') {

                alert(data.body.message)
            } else {
                alert(data.body.message)
            }
        }
    } else {
        alert("Passwords do not match!")
    }
}


async function updateUserToDatabase() {
    let username = document.getElementById('newUsername').value
    let email = document.getElementById('newEmail').value
    let firstName = document.getElementById('newFirstName').value
    let lastName = document.getElementById('newLastName').value
    let userRole = document.getElementById('selectionUserRoles2').value

    if (!username || !firstName || !lastName || !userRole){
        alert("Fill all required fields.")
        return
    }
    let response = await sendJsonRequest('/dashboard/users', {
        action: 'update-user',
        payload: {
            "username": username,
            "id": userId,
            "role": userRole,
            "firstname": firstName,
            "lastname": lastName
        }
    })
    if (response.status === 200) {
        let data = await response.json()
        if (data.statusMessage === 'success') {
            let userTable = document.getElementById("userTable")
            for (let i = 0, row; row = userTable.rows[i]; i++) {
                if (row.cells[0].innerText == userId) {
                    row.cells[1].innerText = username
                    row.cells[2].innerText = email
                    row.cells[3].innerText = firstName
                    row.cells[4].innerText = lastName
                    row.cells[5].innerText = userRole
                }
            }
            alert(data.body.message)
        } else {
            alert(data.body.message)
        }
    }
}

async function editUser() {
    userId = event.target.id.split('-')[2]
    let userTable = document.getElementById("userTable")

    for (let i = 0, row; row = userTable.rows[i]; i++) {
        if (row.cells[0].innerText == userId) {

            document.getElementById('newUsername').value = row.cells[1].innerText
            document.getElementById('newEmail').value = row.cells[2].innerText
            document.getElementById('newFirstName').value = row.cells[3].innerText
            document.getElementById('newLastName').value = row.cells[4].innerText
            document.getElementById('selectionUserRoles2').value = row.cells[5].innerText
        }
    }
}

function clearTable() {
    let userTable = document.getElementById("userTable")
    userTable.innerHTML = '';
}

async function getUserData() {
    reqBody = {
        'action': 'get-users'
    }
    let response = await sendJsonRequest('/dashboard/users', reqBody)
    if (response.status === 200) {
        let data = await response.json()
        clearTable()
        for (const user of data.body.users) {
            addUserToTable(user['id'], user['username'], user['email'], user['firstname'], user['lastname'], user['role'])
        }
    }
}

async function getUserRoles(){
    let response = await  sendJsonRequest('/dashboard/users', {
        'action': 'get-user-roles'
    })
    let data = await response.json()
    let selectionAddUser = document.getElementById('selectionUserRoles1')
    let selectionEditUser = document.getElementById('selectionUserRoles2')

     userRoles = data.body.roles
    let keys =Object.keys(data.body.roles)
    for (const key of keys) {
        selectionAddUser.innerHTML += `<option value="${key}">${userRoles[key]}</option>`
        selectionEditUser.innerHTML += `<option value="${key}">${userRoles[key]}</option>`
    }
}

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