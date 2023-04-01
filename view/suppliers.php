<div class="container">

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
                <button id="btnConfirmDeletion" type="button" data-bs-dismiss="modal" class="btn btn-primary save">Yes
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editSupplierDetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Supplier Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="row text-center  ps-4 pe-4">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Supplier Name</span>
                    <input type="text" class="form-control" aria-describedby="basic-addon1" id="newSupplierName" placeholder="*Supplier Name">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon2">Medical Referance</span>
                    <input type="text" class="form-control " aria-describedby="basic-addon2" id="newMedRef" placeholder="*Medical Referance">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Contact Number</span>
                    <input type="number" class="form-control" aria-describedby="basic-addon3" id="newContactNum" placeholder="*Contact Number">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="update">Update</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="addNewSupplier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="row text-center  ps-4 pe-4">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Supplier Name</span>
                    <input type="text" class="form-control" aria-describedby="basic-addon1" id="supplierName" placeholder="*Supplier Name">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon2">Medical Referance</span>
                    <input type="text" class="form-control " aria-describedby="basic-addon2" id="medRef" placeholder="*Medical Referance">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Contact Number</span>
                    <input type="number" class="form-control" aria-describedby="basic-addon3" id="contactNumber" placeholder="*Contact Number">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addSupplier">Add Supplier</button>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid mt-5 mb-5">
    <div class="row justify-content-end mt-5">
        <div class="col-6 col-sm-4 col-md-3 text-center">
            <h4>Add New Supplier</h4>
            <button class="btn btn-primary fw-bold" type="button" id="btn-add-new" data-bs-toggle="modal"
                    data-bs-target="#addNewSupplier">Add Supplier
            </button>
        </div>
    </div>
    <div class="row text-center mt-5">
        <h2>Suppliers Details</h2>
    </div>
    <div class="row">
        <h4>Filter results</h4>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="input-group mb-3">
                <input type="text" id="filterSupplierName" class="form-control" placeholder="Supplier Name"
                       aria-label="Supplier Name"
                       aria-describedby="btnClearFilterSupplierName">
                <button class="btn btn-danger fw-bold" type="button" id="btnClearFilterSupplierName">clear</button>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group mb-3">
                <input type="text" id="filterMedicalRef" class="form-control" placeholder="Medical Reference"
                       aria-label="Contact Number"
                       aria-describedby="btnClearFilterMedicalRef">
                <button class="btn btn-danger fw-bold" type="button" id="btnClearFilterMedicalRef">clear</button>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group mb-3">
                <input type="number" id="filterContactNumber" class="form-control" placeholder="Contact Number"
                       aria-label="Contact Number"
                       aria-describedby="btnClearFilterContactNumber">
                <button class="btn btn-danger fw-bold" type="button" id="btnClearFilterContactNumber">clear</button>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="container-fluid">
            <div class="col overflow-auto">
                <table class="table table-striped-columns table-hover">
                    <thead class="table-dark">
                    <tr>
                        <th>Id</th>
                        <th>Supplier Name</th>
                        <th>Medical Referance</th>
                        <th>Contact Number</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody id="supplierTable">
                    </tbody>
                </table>
            </div>
            <nav aria-label="Page navigation">
                <ul id="paginationButtons" class="pagination pagination-sm justify-content-center mb-5">
                </ul>
            </nav>
        </div>
    </div>
</div>
</div>
<script src="/assets/js/suppliersPage.js"></script>