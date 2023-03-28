<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{site:title}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body style="overflow-x:hidden;">
<style>
    ul a:hover {
        background-color: #00091a;
    }
</style>
<header>
    <nav class="navbar navbar-expand-sm sticky-top " style="background-color: midnightblue">
        <a class="navbar-brand text-white pb-0 ps-3" href="#">
            <h4>Stock Management System</h4>
        </a>
        <div class="container-fluid justify-content-end">
            <div class="content-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav ">
                        <li class="nav-item px-1 ">
                            <a class="nav-link rounded-pill text-white px-3 py-2 " href="/dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item px-1 ">
                            <a class="nav-link rounded-pill text-white px-3 py-2" href="/dashboard/stocks">Stock</a>
                        </li>
                        <li class="nav-item px-1 ">
                            <a class="nav-link rounded-pill text-white px-3 py-2 " href="/dashboard/suppliers">Suppliers</a>
                        </li>
                        <li class="nav-item px-1 ">
                            <a class="nav-link rounded-pill text-white px-3 py-2 " href="/dashboard/reports">Reports</a>
                        </li>
                        <li class="nav-item px-1 ">
                            <a class="nav-link rounded-pill text-white px-3 py-2 " href="/dashboard/users">Users</a>
                        </li>
                        <li class="nav-item px-1 ">
                            <a class="nav-link rounded-pill text-white px-3 py-2 " href="/dashboard/logout">Log Out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>