let itemInfo = [{
  id:132,
  productName:"injection",
  quantity:6,
  buyingDate:"2020/2/23",
  expiryDate:"2021/3/23",
  companyName:"zzzaffsdfs",
  price:500,
},
{
  id:132324,
  productName:"injectionOtwe",
  quantity:64,
  buyingDate:"2020/2/23",
  expiryDate:"2021/3/23",
  companyName:"qaaaqqqaffsdfs",
  price:500,
},
{
  id:132,
  productName:"injectiontTwer",
  quantity:346,
  buyingDate:"2020/2/23",
  expiryDate:"2021/3/23",
  companyName:"affssdfadfdadfs",
  price:500,
}
]

window.addEventListener("load",function(){
  for(i of itemInfo){
      let itemTable = document.getElementById("itemTable")

      let newRow = itemTable.insertRow(-1)

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
      <button class="btn btn-primary fw-bold" type="button" data-bs-toggle="modal" data-bs-target="#changeProductDetails">Edit Details</button>
      <button class="btn btn-danger fw-bold" type="button">Delete</button>
  </div>`

  }
})


window.addEventListener("load",function(){
        let addNewItem = document.getElementById("addItem")
        addNewItem.addEventListener("click",function(){
          let itemName = document.getElementById("productName").value
          let quantity = document.getElementById("quantity").value
          let buyingDate = document.getElementById("buyingDate").value
          let expDate = document.getElementById("expDate").value
          let companyName = document.getElementById("cmpnyName").value
          let price  = document.getElementById("price").value

          let newItem = {
            itemName,
            quantity,
            buyingDate,
            expDate,
            companyName,
            price
          }
          
          const options = {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json',
            },
            body: JSON.stringify(newItem),
            };
            
            fetch('/dashboard/stocks', options)
  .then(data => {
      if (!data.ok) {
        throw Error(data.status);
       }
       console.log(data)
      }).catch(e => {
      console.log(e);
      });

        })
})