<div class="modal fade" id="addNewItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
</div>
      <div class="row text-center  ps-4 pe-4">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Product Name</span>
            <input type="text" class="form-control" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon2">Quantity</span>
            <input type="number" class="form-control " aria-describedby="basic-addon2">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3">Buying Date</span>
            <input type="date" class="form-control" aria-describedby="basic-addon3">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon4">Expiry Date</span>
            <input type="date" class="form-control" aria-describedby="basic-addon4">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroupSelect01">Company Name</span>
            <select class="form-select" aria-label="Select Company">
                    <option selected>Supplier Company</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon4">Price</span>
            <input type="number" class="form-control" aria-describedby="basic-addon4">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Add Item</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="changeProductDetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Product Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
</div>
      <div class="row text-center  ps-4 pe-4">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Product Name</span>
            <input type="text" class="form-control" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon2">Quantity</span>
            <input type="number" class="form-control " aria-describedby="basic-addon2">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3">Buying Date</span>
            <input type="date" class="form-control" aria-describedby="basic-addon3">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon4">Expiry Date</span>
            <input type="date" class="form-control" aria-describedby="basic-addon4">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroupSelect01">Company Name</span>
            <select class="form-select" aria-label="Select Company">
                    <option selected>Supplier Company</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon4">Price</span>
            <input type="number" class="form-control" aria-describedby="basic-addon4">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid mt-5">
    <h2 class="">All Medical Items</h2>
    <label type="button" class="btn btn-primary mb-4 mt-3" data-bs-toggle="modal" data-bs-target="#addNewItem">Add New
      Item</label>
    <div class="row">
        <h4>Filter results</h4>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Product Name" aria-label="Product Name"
                       aria-describedby="button-addon1">
                <button class="btn btn-danger fw-bold" type="button" id="button-addon1">clear</button>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Retail Price" aria-label="Retail Price"
                       aria-describedby="button-addon2">
                <button class="btn btn-danger fw-bold" type="button" id="button-addon2">clear</button>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group mb-3">
                <select class="form-select" aria-label="Select Company">
                    <option selected>Supplier Company</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
                <button class="btn btn-danger fw-bold" type="button" id="button-addon2">clear</button>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="container-fluid overflow-auto">
            <table class="table table-striped-columns table-hover">
                <thead class="table-dark">
                <tr>
                    <th>Id</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Buying Date</th>
                    <th>Expiry Date</th>
                    <th>Company Name</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>Injection 1</td>
                    <td>5</td>
                    <td>2023-03-20</td>
                    <td>2023-06-20</td>
                    <td>Bla Enterprise</td>
                    <td>500</td>
                    <td>
                        <div class="input-group mb-3">
                            <button class="btn btn-primary fw-bold" type="button" data-bs-toggle="modal" data-bs-target="#changeProductDetails">Edit Details</button>
                            <button class="btn btn-danger fw-bold" type="button">Delete</button>
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

