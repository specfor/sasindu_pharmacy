<style>
    body{
        background: linear-gradient(157deg, rgba(26, 123, 218, 0.5802696078431373) 0%, rgba(255, 255, 255, 0.7819502801120448) 34%, rgba(255, 255, 255, 0.7455357142857143) 58%, rgba(26, 123, 218, 0.227328431372549) 100%) fixed;
    }
</style>
<div class="container mb-5 mt-5 text-center">
    <section id="ExpiringItems"></section>
    <div class="row text-center mt-5">
        <h2>Items About to Expire</h2>
    </div>
    <div class="row text-start">
        <h4>Filter results</h4>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="input-group mb-3">
                <input id="expiringProductNameFilter" type="text" class="form-control" placeholder="Product Name"
                       aria-label="Product Name"
                       aria-describedby="btnClearFilterProductName">
                <button class="btn btn-danger fw-bold" type="button" id="btnClearFilterProductNameExpiring">clear</button>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group mb-3">
                <input id="expiringPriceFilter" type="number" class="form-control" placeholder="Retail Price"
                       aria-label="Retail Price"
                       aria-describedby="btnClearFilterPrice">
                <button class="btn btn-danger fw-bold" type="button" id="btnClearFilterPriceExpiring">clear</button>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group mb-3">
                <select id="expiringSuppliersFilter" class="form-select" aria-label="Select Supplier">
                    <option value="-1">Select Supplier to filter</option>
                </select>
                <button class="btn btn-danger fw-bold" type="button" id="btnClearFilterSupplierExpiring">clear</button>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="container-fluid overflow-auto">
            <table class="table table-striped-columns table-hover">
                <thead class="table-dark">
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Buying Date</th>
                    <th>Expiry Date</th>
                    <th>Supplier Name</th>
                    <th>Price</th>
                </tr>
                </thead>
                <tbody id="expiringItemTable">

                </tbody>
            </table>
            <nav aria-label="Page navigation">
                <ul id="paginationButtonsExpiring" class="pagination pagination-sm justify-content-center">

                </ul>
            </nav>
        </div>
    </div>
    <section id="ExpiredItems"></section>
    <div class="row text-center mt-5">
        <h2>Items Already Expired</h2>
    </div>
    <div class="row text-start">
        <h4>Filter results</h4>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="input-group mb-3">
                <input id="expiredProductNameFilter" type="text" class="form-control" placeholder="Product Name"
                       aria-label="Product Name"
                       aria-describedby="btnClearFilterProductName">
                <button class="btn btn-danger fw-bold" type="button" id="btnClearFilterProductNameExpired">clear</button>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group mb-3">
                <input id="expiredPriceFilter" type="number" class="form-control" placeholder="Retail Price"
                       aria-label="Retail Price"
                       aria-describedby="btnClearFilterPrice">
                <button class="btn btn-danger fw-bold" type="button" id="btnClearFilterPriceExpired">clear</button>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group mb-3">
                <select id="expiredSuppliersFilter" class="form-select" aria-label="Select Supplier">
                    <option value="-1">Select Supplier to filter</option>
                </select>
                <button class="btn btn-danger fw-bold" type="button" id="btnClearFilterSupplierExpired">clear</button>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="container-fluid overflow-auto">
            <table class="table table-striped-columns table-hover">
                <thead class="table-dark">
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Buying Date</th>
                    <th>Expiry Date</th>
                    <th>Supplier Name</th>
                    <th>Price</th>
                </tr>
                </thead>
                <tbody id="expiredItemTable">

                </tbody>
            </table>
            <nav aria-label="Page navigation mb-5">
                <ul id="paginationButtonsExpired" class="pagination pagination-sm justify-content-center">
                </ul>
            </nav>
        </div>
    </div>
</div>
<script src="/assets/js/expiredItems.js"></script>