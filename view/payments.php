<div class="modal fade" id="addNewPayment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="row text-center ps-4 pe-4" style="">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Payment Method</span>
                    <select class="form-select" name="payment-method" id="payment-method">
                        <option selected value="cheque">cheque</option>
                        <option value="cash">cash</option>
                    </select>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon2">Cheque Number</span>
                    <input type="number" class="form-control " aria-describedby="basic-addon2" id="cheque-number">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Amount</span>
                    <input type="number" class="form-control" aria-describedby="basic-addon3" id="amount">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon4">Paid Date</span>
                    <input type="date" class="form-control" aria-describedby="basic-addon4" id="paid-date">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" >Paid To</span>
                    <select class="form-select" id="inputGroupSelect01">
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="add-payment">Add Payment</button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mb-5">
    <div class="row justify-content-end mt-5">
        <div class="col-6 col-sm-4 col-md-3 text-center">
            <h4>Add New Payment</h4>
            <button class="btn btn-primary fw-bold" type="button" id="addPayment" data-bs-toggle="modal"
                    data-bs-target="#addNewPayment">Add Payment
            </button>
        </div>
    </div>
    <div class="row text-center mt-5">
        <h3>Payment Details</h3>
    </div>
    <div class="row ">
        <div class="col-12 ">
            <div class="container-fluid overflow-auto m-2">
                <table class="table table-striped-columns table-hover">
                    <thead class="table-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col">Cheque Number</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Paid Date</th>
                        <th scope="col">Paid to</th>
                    </tr>
                    </thead>
                    <tbody id="paymentTable">

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
<script src="/assets/js/payments.js"></script>