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
        mainMenu.innerHTML += `<button type="button" onclick="window.location.href='/dashboard/reports'" class="btn btn-outline-primary p-3 m-2" style="min-width:10vw; " >Reports</button>`
        mainMenu.innerHTML += `<button type="button" onclick="window.location.href='/dashboard/users'" class="btn btn-outline-primary p-3 m-2" style="min-width:10vw; " >Users</button>`
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