//This eventlisner operates when the dom is loaded and company name filter is clicked
window.addEventListener('load', () => {
  let companyName = document.getElementById('companyName')
  companyName.addEventListener('click', (event) => {
    event.preventDefault()
    let companyFilterOption = document.getElementById('companyFilter')
    companyFilterOption.style.display = "inline"
  })
})

//Removes the company name filter
window.addEventListener('load', () => {
  let removeFilter = document.getElementById("removeFilter")
  removeFilter.addEventListener("click", function(event) {
    let companyFilterOption = document.getElementById('companyFilter')
    companyFilterOption.style.display = "none"
  })
})

//This eventlisner operates when the dom is loaded and retail price filter is clicked
window.addEventListener('load', () => {
  let retailPrice = document.getElementById("retailPrice")
  retailPrice.addEventListener("click", function(event) {
    let priceInput = document.getElementById("priceInput")
    let priceRemove = document.getElementById("removeRetailPrice")
    priceInput.style.display = "inline"
    priceRemove.style.display = "inline"
  })
})

//removes the retail price input
window.addEventListener('load', () => {
  let removeRetailPrice = document.getElementById("removeRetailPrice")
  removeRetailPrice.addEventListener("click", function(event) {
    let priceInput = document.getElementById("priceInput")
    priceInput.style.display = "none"
    removeRetailPrice.style.display = "none"
  })
})



