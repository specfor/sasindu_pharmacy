<div class="container">

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
                    <input type="text" class="form-control" aria-describedby="basic-addon1" id="productName">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon2">Quantity</span>
                    <input type="number" class="form-control " aria-describedby="basic-addon2" id="quantity">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Buying Date</span>
                    <input type="date" class="form-control" aria-describedby="basic-addon3" id="buyingDate">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon4">Expiry Date</span>
                    <input type="date" class="form-control" aria-describedby="basic-addon4" id="expDate">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroupSelect01">Supplier Name</span>
                    <select class="form-select" aria-label="Select Company" id="supplierId">
                    </select>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon4">Price</span>
                    <input type="number" class="form-control" aria-describedby="basic-addon4" id='price'>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnAddItem">Add Item</button>
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
                    <input type="text" class="form-control" aria-describedby="basic-addon1" id="newProductName">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon2">Quantity</span>
                    <input type="number" class="form-control " aria-describedby="basic-addon2" id="newQuantity">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Buying Date</span>
                    <input type="date" class="form-control" aria-describedby="basic-addon3" id="newBuyingDate">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon4">Expiry Date</span>
                    <input type="date" class="form-control" aria-describedby="basic-addon4" id="newExpDate">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroupSelect01">Company Name</span>
                    <select class="form-select" aria-label="Select Company" id="newSupplierId">

                    </select>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon4">Price</span>
                    <input type="number" class="form-control" aria-describedby="basic-addon4" id="newPrice">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSaveChanges">Save changes</button>
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

<div class="container-fluid mt-5">
    <h2 class="">All Medical Items</h2>
    <label id="btn-add-new-item" type="button" class="btn btn-primary mb-4 mt-3" data-bs-toggle="modal"
           data-bs-target="#addNewItem">Add New
        Item</label>
    <div class="row">
        <h4>Filter results</h4>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="input-group mb-3">
                <input id="productNameFilter" type="text" class="form-control" placeholder="Product Name" aria-label="Product Name"
                       aria-describedby="btnClearFilterProductName">
                <button class="btn btn-danger fw-bold" type="button" id="btnClearFilterProductName">clear</button>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group mb-3">
                <input id="priceFilter" type="number" class="form-control" placeholder="Retail Price" aria-label="Retail Price"
                       aria-describedby="btnClearFilterPrice">
                <button class="btn btn-danger fw-bold" type="button" id="btnClearFilterPrice">clear</button>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group mb-3">
                <select id="suppliersFilter" class="form-select" aria-label="Select Supplier">
                    <option value="-1">Select Supplier to filter</option>
                </select>
                <button class="btn btn-danger fw-bold" type="button" id="btnClearFilterSupplier">clear</button>
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
                    <th>Supplier Name</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="itemTable">

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

<script src="/assets/js/stocksScript.js"></script>
