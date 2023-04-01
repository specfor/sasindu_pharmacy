window.addEventListener('load', () => {
    initUI()
})


async function isAdmin() {
    let response = await sendJsonRequest('/dashboard', {
        'action': 'check-admin'
    })
    if (response.status === 200) {
        let data = await response.json()
        return data.body['is-admin'] === true;

    }
}

async function initUI() {
    let Admin = await isAdmin()
    let mainMenu = document.getElementById('mainMenu')

    if (Admin) {
        mainMenu.innerHTML += `<a href="/dashboard/users">Manage Users</a>`
        mainMenu.innerHTML += `<a href="/dashboard/reports">Get Reports</a>`
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