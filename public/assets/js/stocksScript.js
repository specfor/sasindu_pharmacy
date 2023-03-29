let itemInfo = [{
    id: 132,
    productName: "injection",
    quantity: 6,
    buyingDate: "2020/2/23",
    expiryDate: "2021/3/23",
    companyName: "zzzaffsdfs",
    price: 500,
},
    {
        id: 132324,
        productName: "injectionOtwe",
        quantity: 64,
        buyingDate: "2020/2/23",
        expiryDate: "2021/3/23",
        companyName: "qaaaqqqaffsdfs",
        price: 500,
    },
    {
        id: 132,
        productName: "injectiontTwer",
        quantity: 346,
        buyingDate: "2020/2/23",
        expiryDate: "2021/3/23",
        companyName: "affssdfadfdadfs",
        price: 500,
    }
]

window.addEventListener("load", function () {
    updatingTheItemTable(itemInfo)
})


window.addEventListener("load", function () {
    let addNewItem = document.getElementById("addItem")
    addNewItem.addEventListener("click", async function () {
        let itemName = document.getElementById("productName").value
        let quantity = document.getElementById("quantity").value
        let buyingDate = document.getElementById("buyingDate").value
        let expDate = document.getElementById("expDate").value
        let companyName = document.getElementById("cmpnyName").value
        let price = document.getElementById("price").value

        let newItem = {
            action: 'add-item',
            payload: {
                'product-name': itemName,
                'product-amount': quantity,
                'buying-date': buyingDate,
                'expire-date': expDate,
                'supplier-id': companyName,
                'product-price': price
            }
        }

        let options = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(newItem),
            credentials: "same-origin"
        };

        let response = await fetch('/dashboard/stocks', options);
        let data = await response.json();
        console.log(data.statusMessage)
        if(data.statusMessage =="success"){
          //updating the table code goes here
        }else{
            alert("Adding new item failed!")
        }

    })
})


let rowCount = 0 

//This function updates the item table
function updatingTheItemTable(newData){
  for(i of newData){
    let itemTable = document.getElementById("itemTable")

    let newRow = itemTable.insertRow(-1)
    newRow.id = `rowCountStocks${rowCount}`

    let cell1 = newRow.insertCell(0)
    let cell2 = newRow.insertCell(1)
    let cell3 = newRow.insertCell(2)
    let cell4 = newRow.insertCell(3)
    let cell5 = newRow.insertCell(4)
    let cell6 = newRow.insertCell(5)
    let cell7 = newRow.insertCell(6)
    let cell8 = newRow.insertCell(7)

    cell1.innerText = `${i.id}`
    cell2.innerText = `${i.productName}`
    cell3.innerText = `${i.quantity}`
    cell4.innerText = `${i.buyingDate}`
    cell5.innerText = `${i.expiryDate}`
    cell6.innerText = `${i.companyName}`
    cell7.innerText = `${i.price}`
    cell8.innerHTML = `<div class="input-group mb-3">
  <button class="edit btn btn-primary fw-bold" type="button" data-bs-toggle="modal" data-bs-target="#changeProductDetails" id="changeDetailsRow${rowCount}" >Edit Details</button>
  <button class="delete btn btn-danger fw-bold" type="button" id="${rowCount}">Delete</button>
</div>`

    rowCount++

    
  }

}

//Editing stocks
window.addEventListener("load",function(){
  document.querySelectorAll('.edit').forEach((e) => {
    e.onclick = (e) => 
    console.log(e.currentTarget.id)
    let saveChanges = document.getElementById("saveChanges")
    saveChanges.addEventListener("click",function(){
      console.log("item")

      //sendNewDataToTheServer(e.currentTarget.id)

    });
  });
})


//Deleting table rows
window.addEventListener("load",function(){
  document.querySelectorAll('.delete').forEach((e) => {
    e.onclick = (e) => document.getElementById("itemTable").deleteRow(e.currentTarget.id);
  });
})


//This funtion sends new data to the server
async function sendNewDataToTheServer(id){
  let newItemName = document.getElementById("newproductName").value
  let newQuantity = document.getElementById("newquantity").value
  let newBuyingDate = document.getElementById("newbuyingDate").value
  let newExpDate = document.getElementById("newexpDate").value
  let newCompanyName = document.getElementById("newcmpnyName").value
  let newPrice = document.getElementById("newprice").value

  let newItemData = {
    itemID:id,
    newItemName,
    newQuantity,
    newBuyingDate,
    newExpDate,
    newCompanyName,
    newPrice
  }

  console.log(newItemData)

  let options = {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify(newItemData),
    credentials: "same-origin"
};

  
  let response = await fetch('/dashboard/stocks', options);
  let data = await response.json();
  console.log(data.statusMessage)
  if(data.statusMessage =="success"){
    //updating the table code goes here
    console.log(newItemData)
  }else{
      alert("Changing item details failed")
  }
}