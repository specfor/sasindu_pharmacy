<style>
    body {
        background: linear-gradient(157deg, rgba(26, 123, 218, 0.5802696078431373) 0%, rgba(255, 255, 255, 0.7819502801120448) 34%, rgba(255, 255, 255, 0.7455357142857143) 58%, rgba(26, 123, 218, 0.227328431372549) 100%) fixed;
    }
</style>
<div class="container">
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
                        <span class="input-group-text">Bank</span>
                        <select class="form-select" id="bankSelection">
                            <option value="BOC">BOC</option>
                            <option value="People's Bank">People's Bank</option>
                            <option value="Commercial Bank">Commercial Bank</option>
                            <option value="Sampath Bank">Sampath Bank</option>
                            <option value="Nations Trust Bank">Nations Trust Bank</option>
                            <option value="Pan Asia Bank">Pan Asia Bank</option>
                            <option value="DFCC Bank">DFCC Bank</option>
                            <option value="Seylan Bank">Seylan Bank</option>
                            <option value="Cargills Bank">Cargills Bank</option>
                            <option value="Hatton National Bank">Hatton National Bank</option>
                            <option value="National Development Bank">National Development Bank</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon2">Cheque Number</span>
                        <input type="number" class="form-control " aria-describedby="basic-addon2" id="cheque-number"
                               placeholder="*Cheque Number">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon3">Amount</span>
                        <input type="number" class="form-control" aria-describedby="basic-addon3" id="amount"
                               placeholder="*Amount">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon4">Paid Date</span>
                        <input type="date" class="form-control" aria-describedby="basic-addon4" id="paid-date">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Paid To</span>
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
            <h2>Payment Details</h2>
        </div>
        <div class="row">
            <h4>Filter results</h4>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="input-group mb-3">
                    <select id="bankFilter" class="form-select" aria-label="Select Bank Name">
                        <option value="-1">Select Bank Name</option>
                        <option value="BOC">BOC</option>
                        <option value="People's Bank">People's Bank</option>
                        <option value="Commercial Bank">Commercial Bank</option>
                        <option value="Sampath Bank">Sampath Bank</option>
                        <option value="Nations Trust Bank">Nations Trust Bank</option>
                        <option value="Pan Asia Bank">Pan Asia Bank</option>
                        <option value="DFCC Bank">DFCC Bank</option>
                        <option value="Seylan Bank">Seylan Bank</option>
                        <option value="Cargills Bank">Cargills Bank</option>
                        <option value="Hatton National Bank">Hatton National Bank</option>
                        <option value="National Development Bank">National Development Bank</option>
                    </select>
                    <button class="btn btn-danger fw-bold" type="button" id="btnClearFilterBank">clear</button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group mb-3">
                    <select id="paymentMethodFilter" class="form-select" aria-label="Select Payment Method">
                        <option value="-1">Select Payment Method</option>
                        <option value="cheque">cheque</option>
                        <option value="cash">cash</option>
                    </select>
                    <button class="btn btn-danger fw-bold" type="button" id="btnClearFilterPaymentMethod">clear</button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group mb-3">
                    <select id="paidToFilter" class="form-select" aria-label="Select the Payment receiver">
                        <option value="-1">Select Supplier</option>

                    </select>
                    <button class="btn btn-danger fw-bold" type="button" id="btnClearFilterSupplier">clear</button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group mb-3">
                    <input type="date" class="form-control" aria-describedby="basic-addon4" id="paid-dateFilter">
                    <button class="btn btn-danger fw-bold" type="button" id="btnClearFilterPaidDate">clear</button>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-12 ">
                <div class="container-fluid text-center m-2">
                    <div class="col overflow-auto">
                        <table class="table table-striped-columns table-hover ">
                            <thead class="table-dark">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Payment Method</th>
                                <th scope="col">Cheque Number</th>
                                <th scope="col">Bank Name</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Paid Date</th>
                                <th scope="col">Paid to</th>
                            </tr>
                            </thead>
                            <tbody id="paymentTable">

                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Page navigation">
                        <ul id="paginationButtons" class="pagination pagination-sm justify-content-center">
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

</div>


<script src="/assets/js/payments.js"></script>