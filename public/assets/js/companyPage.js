

window.addEventListener("load",function(){
    let addCompanyButton = document.getElementById("addCompany")
    addCompanyButton.addEventListener('click',function(){
        let companyName = document.getElementById("companyName")
        let medRef = document.getElementById("medRef")
        let contactNum = document.getElementById("contactNumber")
    
        let newCompanyObject = {
            companyName:companyName.value,
            medicalReferance:medRef.value,
            contactNumber:contactNum.value,
        }
    
        const options = {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json',
            },
            body: JSON.stringify(newCompanyObject),
            };

            fetch('', options)
  .then(data => {
      if (!data.ok) {
        throw Error(data.status);
       }
       return data.json();
      }).then(update => {
      console.log(update);
      }).catch(e => {
      console.log(e);
      });
    })

})

let sampleArray = [
    {
        id:34,
        companyName:"union",
        contactNumbr:0412342342,
        medicalReferance:"adf23424",
    },
    {
        id:35,
        companyName:"abec",
        contactNumbr:0212342342,
        medicalReferance:"adf23ssdf424",
    },
    {
        id:34,
        companyName:"leap",
        contactNumbr:0312342342,
        medicalReferance:"adfasdfasf23424",
    }
]

window.addEventListener("load",function(){
    for(i of sampleArray){
        let companyTable = document.getElementById("companyTable")

        let newRow = companyTable.insertRow(-1)

        let cell1 = newRow.insertCell(0)
        let cell2 = newRow.insertCell(1)
        let cell3 = newRow.insertCell(2)
        let cell4 = newRow.insertCell(3)
        let cell5 = newRow.insertCell(4)

        cell1.innerText = `${i.id}`
        cell2.innerText = `${i.companyName}`
        cell3.innerText = `${i.medicalReferance}`
        cell4.innerText = `${i.contactNumbr}`
        cell5.innerHTML = `<div class="input-group mb-3">
        <button class="btn btn-primary fw-bold" type="button" data-bs-toggle="modal"
          data-bs-target="#editCompanyDetails">Edit Details</button>
        <button class="btn btn-danger fw-bold" type="button">Delete</button>
      </div>`

    }
})