window.addEventListener('load', () => {
    initUI()
    getAboutToExpireItemCount()
    getStockValue()
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

async function getAboutToExpireItemCount() {
    let response = await sendJsonRequest('/dashboard', {
        'action': 'get-expiring-item-count'
    })
    if (response.status === 200) {
        let data = await response.json()
        let upcomingExprieCountBtn = document.getElementById('upcomingExpireCount')
        if (data.body['item-count'] === 0) {
            upcomingExprieCountBtn.innerText = "No Items About to Expirie"
        } else if (data.body['item-count'] < 100) {
            upcomingExprieCountBtn.innerHTML =
                `Items About To Expire<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                ${data.body['item-count']}<span class="visually-hidden">unread messages</span></span>`
        } else {
            upcomingExprieCountBtn.innerHTML =
                `A Lot To Expire<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                ${data.body['item-count']}<span class="visually-hidden">unread messages</span></span>`
        }
        console.log(data)
    }
}

async function getStockValue() {
    let response = await sendJsonRequest('/dashboard', {
        'action': 'get-stock-value'
    })
    if (response.status === 200) {
        let data = await response.json()
        let stockValueLabel = document.getElementById('stockValue')
        stockValueLabel.innerText = "Rs. " + data.body['stock-value']
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