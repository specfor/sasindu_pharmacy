window.addEventListener("load",function(){
    document.getElementById("addNewUser").addEventListener("click",clearAllInputs)
    document.getElementById("addUser").addEventListener("click",sendUserData2DB)

})

function clearAllInputs(){
    document.getElementById("username").value = ''
    document.getElementById("email").value = ''
    document.getElementById("firstName").value = ''
    document.getElementById("password").value = ''

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
    }
})
if (response.status === 200) {
    let data = await response.json()
    if (data.statusMessage === 'success') {
        clearAllInputs()
        alert(data.body.message)
        console.log(data.body.message)
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