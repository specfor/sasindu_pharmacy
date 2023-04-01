<div class="container">

<div class="modal fade" id="addNewUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      </div>
    <div class="row text-center ps-4 pe-4" style="">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Username</span>
            <input type="text" class="form-control" aria-describedby="basic-addon1" id="username" placeholder="*Username">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon2">Email</span>
            <input type="email" class="form-control " aria-describedby="basic-addon2" id="email" placeholder="Email">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3">First Name</span>
            <input type="text" class="form-control" aria-describedby="basic-addon3" id="firstName" placeholder="*First Name">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon4">Last Name</span>
            <input type="text" class="form-control" aria-describedby="basic-addon4" id="lastName" placeholder="*Last Name">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon4">Password</span>
            <input type="password" class="form-control" aria-describedby="basic-addon4" id="password" placeholder="*Password">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" >User Role</span>
            <select class="form-select" id="selectionUserRoles1" >
            </select>
        </div>
        <p>Note - "Data Entry Operator" does not have permission to visit "Reports" and "Users" pages.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="addUser">Add User</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" id="confirmDelete" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Confirm Deletion</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>This action is irreversible. Are you sure you want to delete this data?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="btnConfirmDeletion" type="button" data-bs-dismiss="modal" class="btn btn-primary save">Yes</button>
            </div>
        </div>
    </div>
</div>

<!--This div is about the pop up change user details -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <input type="text" class="form-control" aria-describedby="basic-addon1" id="newUsername" placeholder="*Username">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon2">Email</span>
            <input type="email" class="form-control " aria-describedby="basic-addon2" id="newEmail" placeholder="Email">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3">First Name</span>
            <input type="text" class="form-control" aria-describedby="basic-addon3" id="newFirstName" placeholder="*First Name">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon4">Last Name</span>
            <input type="text" class="form-control" aria-describedby="basic-addon4" id="newLastName" placeholder="*Last Name">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" >User Role</span>
            <select class="form-select" id="selectionUserRoles2" >
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
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <input type="password" class="form-control" aria-describedby="basic-addon1" id="newUserPassword" placeholder="*Password">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Confirm Password</span>
            <input type="password" class="form-control" aria-describedby="basic-addon1" id="newUserPasswordConfirm" placeholder="*Confirm Password">
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
      </div class="row">
      <button id="addNewUser" class="btn btn-primary mt-3 mb-3"  data-bs-toggle="modal" data-bs-target="#addNewUserModal">Add New User</button>
      <div> 
      </div>    
    <div class="row ">
        <div class="col-12 ">
            <div class="container-fluid overflow-auto m-2">
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
                    <tbody id="userTable">
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

</div>


<script src="/assets/js/usersPage.js"></script>