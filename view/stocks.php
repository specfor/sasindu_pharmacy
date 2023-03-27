<div class="searchDiv dropdown container-fluid">
  <form action="#">
    <input type="text" placeholder="Search.." name="search" class="searchInput">
    <button type="submit" class="searchButton"><i class="fa fa-search"></i></button>
    <button type="button" class="btn btn-info" id="removeRetailPrice">-</button>
    <input type="text" class="form-control" id="priceInput" placeholder="Retail Price">
    <div class="dropdown" style="display: none;" id="companyFilter">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
        Company Name
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="#" id="removeFilter">Remove Filter</a>
        <a class="dropdown-item" href="#">+ </a>
        <a class="dropdown-item" href="#">+ </a>
      </div>
    </div>
    <div class="dropdown">
      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
        Filters
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="#" id="companyName">+ Company Name</a>
        <a class="dropdown-item" href="#" id="retailPrice">+ Retail Price</a>
      </div>
    </div>
  </form>

</div>
<div class="container-fluid" style="margin-top:5vh;">
<h2>All medical items</h2>
<p>This table is about all medicine</p>
<table class=" table table-striped">
  <thead>
  <tr>
    <th>Product Name</th>
    <th>Id</th>
    <th>Quantity</th>
    <th>Production Date</th>
    <th>Expiry Date</th>
    <th>Company Name</th>
    <th>Price</th>
    <th>Edit</th>
  </tr>
  </thead>
  <tbody>

  </tbody>
</table>
</div>

