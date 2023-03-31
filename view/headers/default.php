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
        /*background-color: #00091a;*/
        background-color: black;
        color:white;
    }
    .active{
        background-color: white;
    }
</style>
<header>
    

    <nav class="navbar navbar-expand-sm sticky-top  justify-content-end " style="background-color: midnightblue">
        
        <div class="container">

        <a class="navbar-brand text-white pb-0 ps-3" href="#">
                
            <h4>Stock Management System</h4>
        
        </a>


            <div class="contect-fluid  justify-content-evenly text-primary">
                <nav class="navbar navbar-expand-lg  px-4 text-white-50">
                    <div class="container-fluid px-3 text-primary">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-lg-item">
                            <a class="nav-link active text-light rounded active" aria-current="page" href="#">Dashboard</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link  text-light rounded" href="#">Stock</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link text-light rounded " href="#">Reports</a>
                            </li>
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light rounded" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Profile
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Info</a></li>
                                <li><a class="dropdown-item" href="#">Manage users</a></li>
                                <li><a class="dropdown-item" href="#">Log out</a></li>
                            </ul>
                            </li>
                        </ul>
                        </div>
                    </div>
                </nav>
            </div>

            <!--
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
                                <a onclick="logOut()" class="nav-link rounded-pill text-white px-3 py-2 " href="#">Log Out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            -->

        </div>
    </nav>

    
    
</header>
<script>
    async function logOut(){
        let response = fetch('/dashboard/logout',
            {
                method: 'POST',
                credentials: 'same-origin'
            })
        if((await response).status === 200){
            window.location.href = "/"
        }
    }
</script>