<div class="container mt-5 text-center">
    <div class="row text-center mt-5">
        <h2>Items About to Expire</h2>
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
    <div class="row text-center mt-5">
        <h2>Items Already Expired</h2>
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
            <nav aria-label="Page navigation">
                <ul id="paginationButtonsExpired" class="pagination pagination-sm justify-content-center">
                </ul>
            </nav>
        </div>
    </div>
</div>
<script src="/assets/js/expiredItems.js"></script>