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

<div class="modal fade" id="editCompanyDetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Company Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        </div>
        <div class="row text-center  ps-4 pe-4">
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Company Name</span>
            <input type="text" class="form-control" aria-describedby="basic-addon1" id="newCompanyName">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon2">Medical Referance</span>
            <input type="text" class="form-control " aria-describedby="basic-addon2" id="newMedRef">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3">Contact Number</span>
            <input type="number" class="form-control" aria-describedby="basic-addon3" id="newContactNum">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="update">Update</button>
        </div>
      </div>
    </div>
  </div>



  <div class="modal fade" id="addNewCompany" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Company</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        </div>
        <div class="row text-center  ps-4 pe-4">
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Company Name</span>
            <input type="text" class="form-control" aria-describedby="basic-addon1" id="companyName">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon2">Medical Referance</span>
            <input type="text" class="form-control " aria-describedby="basic-addon2" id="medRef">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3">Contact Number</span>
            <input type="number" class="form-control" aria-describedby="basic-addon3" id="contactNumber">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="addCompany">Add Company</button>
        </div>
      </div>
    </div>
  </div>


  <div class="container-fluid mt-5">
    <h2 class="">All Companies</h2>
    <label type="button" class="btn btn-primary mb-4 mt-3" data-bs-toggle="modal" data-bs-target="#addNewCompany" id="btn-add-new">Add
      New
      Company</label>
    <div class="row">
      <h4>Filter results</h4>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Company Name" aria-label="Company Name"
            aria-describedby="button-addon1">
          <button class="btn btn-danger fw-bold" type="button" id="button-addon1">clear</button>
        </div>
      </div>
      <div class="col-md-3">
        <div class="input-group mb-3">
          <input type="number" class="form-control" placeholder="Contact Number" aria-label="Contact Number"
            aria-describedby="button-addon2">
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
              <th>Company Name</th>
              <th>Medical Referance</th>
              <th>Contact Number</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id="companyTable">
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
<script src="/assets/js/companyPage.js"></script>