<style>
    body{
        background: linear-gradient(157deg, rgba(26, 123, 218, 0.5802696078431373) 0%, rgba(255, 255, 255, 0.7819502801120448) 34%, rgba(255, 255, 255, 0.7455357142857143) 58%, rgba(26, 123, 218, 0.227328431372549) 100%) fixed;
    }
</style>
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