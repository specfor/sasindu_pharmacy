let userId

window.addEventListener("load",function(){
    document.getElementById("addNewUser").addEventListener("click",clearAllInputs)
    document.getElementById("addUser").addEventListener("click",sendUserData2DB)
    document.getElementById('update').addEventListener('click', updateUserToDatabase)

})

function clearAllInputs(){
    document.getElementById("username").value = ''
    document.getElementById("email").value = ''
    document.getElementById("firstName").value = ''
    document.getElementById("password").value = ''
    document.getElementById("lastName").value = ''

}

async function sendUserData2DB(){
   let username = document.getElementById("username").value 
   let email =  document.getElementById("email").value 
   let fName = document.getElementById("firstName").value
   let lName = document.getElementById("lastName").value
   let password = document.getElementById("password").value 
   let userRole = document.getElementById("inputGroupSelect01")

    role = userRole.options[userRole.selectedIndex].value
    console.log(role)

   let response = await sendJsonRequest('/dashboard/users', {
    action: 'add-user',
    payload: {
        username:username,
        password:password,
        role:Number(role),
        firstname:fName,
        lastname:lName,
        email:email,
        dev:true,
    }
})
if (response.status === 200) {
    let data = await response.json()
    console.log(data)
    if (data.statusMessage === 'success') {
        clearAllInputs()
        //call the func to update the table here


        alert(data.body.message)
        console.log(data.body.message)
    } else {
        alert(data.body.message)
        console.log(data.body.message)
    }
}
}

async function updateUserToDatabase() {
    
    let username = document.getElementById('newUsername').value
    let email = document.getElementById('newEmail').value
    let firstName = document.getElementById('newFirstName').value
    let lastName = document.getElementById('newLastName').value
    let userRole = document.getElementById('newInputGroupSelect01').value


    let response = await sendJsonRequest('/dashboard/users', {
        action: 'update-user',
        payload: {
            "username":username,
            "id":userId,
            "role":userRole,
            "firstname":firstName,
            "lastname":lastname

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
            let modalElement = document.getElementById('exampleModal')
            let modal = new bootstrap.Modal(modalElement)
            modal.hide()
            alert(data.body.message)

        } else {
            alert(data.body.message)
            console.log(data.body.message)
        }
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