<div class="container-fluid mb-5">
    <div class="row text-center mt-5">
        <h3>Manage Access of System Users</h3>
    </div>
    <div class="row">
        <div class="col-lg-8 overflow-auto">
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
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
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
        <div class="col-lg-4">
            <div class="container mt-2 mt-lg-5 ml-2 mb-3">
                <div class="row text-center mb-3">
                    <h4>Edit User Details</h4>
                </div>
                <div class="row text-center">
                    <fieldset disabled>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Username</span>
                            <input type="text" class="form-control" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon2">Email</span>
                            <input type="email" class="form-control " aria-describedby="basic-addon2">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon3">First Name</span>
                            <input type="text" class="form-control" aria-describedby="basic-addon3">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon4">Last Name</span>
                            <input type="text" class="form-control" aria-describedby="basic-addon4">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroupSelect01">User Role</span>
                            <select class="form-select" id="inputGroupSelect01">
                                <option selected value="1">Administrator</option>
                                <option value="2">Data Entry Operator</option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-outline-primary">Update</button>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>