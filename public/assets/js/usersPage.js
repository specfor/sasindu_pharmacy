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
