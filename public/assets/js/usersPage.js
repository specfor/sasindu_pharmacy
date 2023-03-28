window.addEventListener('load', () => {
    let update = document.getElementById('update')
    update.addEventListener('click', (event) => {
        event.preventDefault()

        let username = document.getElementById('username').value

        let email = document.getElementById('email').value

        let firstName = document.getElementById('firstName').value

        let lastName = document.getElementById('lastName').value

        console.log(`${username} ${email} ${firstName} ${lastName}`)
    })
})

window.addEventListener('load', () => {
    let changePassButton = document.getElementById('changePass')
    changePassButton.addEventListener('click', (event) => {
        event.preventDefault()
        let newUserPassword = document.getElementById("newUserPassword").value
        console.log(newUserPassword)
    })
})

let userArray = [
    {
        id:132,
        username:"buddy",
        email:"qweasdfsf@sm.com",
        firstName:"bruce",
        lastName:"lee",
        userRole:"admin",
      },    {
        id:2132,
        username:"asdf",
        email:"werasdfsf@sm.com",
        firstName:"bret",
        lastName:"wef",
        userRole:"iudsf",
      }  , {
        id:3132,
        username:"gsfda",
        email:"asdfsf@sm.com",
        firstName:"zzasf",
        lastName:"lasfghh",
        userRole:"admin",
      }
]

window.addEventListener("load",function(){
    for(i of userArray){
        let userTable = document.getElementById("userTable")

        let newRow = userTable.insertRow(-1)

        let cell1 = newRow.insertCell(0)
        let cell2 = newRow.insertCell(1)
        let cell3 = newRow.insertCell(2)
        let cell4 = newRow.insertCell(3)
        let cell5 = newRow.insertCell(4)
        let cell6 = newRow.insertCell(5)
        let cell7 = newRow.insertCell(6)

        cell1.innerText = `${i.id}`
        cell2.innerText = `${i.email}`
        cell3.innerText = `${i.username}`
        cell4.innerText = `${i.firstName}`
        cell5.innerText = `${i.lastName}`
        cell6.innerText = `${i.userRole}`
        cell7.innerHTML = `<div class="input-group mb-3">
        <button class="btn btn-primary fw-bold" type="button" id="editDetails" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit Details</button>
        <button class="btn btn-primary fw-bold" type="button" id="changePass" data-bs-toggle="modal" data-bs-target="#changePassword">Change Password</button>
    </div>`


    }
})