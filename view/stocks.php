<div class="container-fluid mt-5">
    <h2 class="mb-5">All Medical Items</h2>

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
                    <button class="btn btn-primary fw-bold" type="button">Edit Details</button>
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

