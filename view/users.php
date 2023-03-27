<script>
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
</script>

<!--This div is about the pop up change user details -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      </div>
    <div class="row text-center ps-4 pe-4" style="">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Username</span>
            <input type="text" class="form-control" aria-describedby="basic-addon1" id="username">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon2">Email</span>
            <input type="email" class="form-control " aria-describedby="basic-addon2" id="email">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3">First Name</span>
            <input type="text" class="form-control" aria-describedby="basic-addon3" id="firstName">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon4">Last Name</span>
            <input type="text" class="form-control" aria-describedby="basic-addon4" id="lastName">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroupSelect01">User Role</span>
            <select class="form-select" id="inputGroupSelect01">
                <option selected value="1">Administrator</option>
                <option value="2">Data Entry Operator</option>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="update">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!--This div is about the pop up change user password -->
<div class="modal fade" id="changePassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="row text-center">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">New Password</span>
            <input type="password" class="form-control" aria-describedby="basic-addon1" id="newUserPassword">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Confirm Password</span>
            <input type="password" class="form-control" aria-describedby="basic-addon1" id="newUserPasswordConfirm">
        </div>        
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="changePass">Save changes</button>
      </div>
    </div>
  </div>
</div>


<div class="container-fluid mb-5">
    <div class="row text-center mt-5">
        <h3>Manage Access of System Users</h3>
    </div>
    <div class="row">
        <div class="col-12 overflow-auto">
            <div class="container-fluid m-2">
                <table class="table table-striped-columns table-hover">
                    <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">User Role</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>2</td>
                        <td>asdf</td>
                        <td>Thornton@gmail.com</td>
                        <td>fat</td>
                        <td>man</td>
                        <td>Administrator</td>
                        <td>
                            <div class="input-group mb-3">
                                <button class="btn btn-primary fw-bold" type="button" id="editDetails" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit Details</button>
                                <button class="btn btn-primary fw-bold" type="button" id="changePass" data-bs-toggle="modal" data-bs-target="#changePassword">Change Password</button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm justify-content-center">
                        <li class="page-item active"><a class="page-link" href="">1</a></li>
                        <li class="page-item"><a class="page-link" href="">2</a></li>
                        <li class="page-item"><a class="page-link" href="">3</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>