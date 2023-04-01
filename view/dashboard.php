<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>
<body>


<style>
    body {
        image.png
        background: rgb(26, 123, 218);
        background: linear-gradient(157deg, rgba(26, 123, 218, 0.5802696078431373) 0%, rgba(255, 255, 255, 0.7819502801120448) 34%, rgba(255, 255, 255, 0.7455357142857143) 58%, rgba(26, 123, 218, 0.227328431372549) 100%);
    }

    .border {
        border: 5px solid black;
    }

    .border_s {
        /*margin-top: 5vh;*/
        justify-content: center;
        align-items: center;
        align-self: center;
    }

    .form {
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        max-width: 60vh;
    }

    @media (max-width: 768px) {
        .aligner {
            width: 100%;
            font-size: 10px;
            display: flex;
            flex-direction: column;
        }

        .aligner label {
            width: 100%;
            margin-bottom: 10px;
            text-align: center;
            font-size: 10px;
        }
    }
        @media (max-width: 992px) {
        .aligner {
            width: 100%;
            font-size: 10px;
            display: flex;
            flex-direction: column;
        }

        .aligner label {
            width: 100%;
            margin-bottom: 10px;
            text-align: center;
            font-size: 0px;
        }
        .ft{

            border-bottom-left-radius: 0px;
            border-bottom-right-radius: 0px;
            border-top-left-radius: 0px;
            border-top-right-radius: 0px;

        }
        .fb{

            border-bottom-left-radius: 0px;
            border-bottom-right-radius: 0px;
            border-top-left-radius: 0px;
            border-top-right-radius: 0px;
        }
        }


</style>
<div class="container  p-1 justify-content-center border_s align-items-center">
    <div class="container p-2">
        <div class="row p-2 mb-4 g-2" style="min-height:95vh">
            <div class="d-flex flex-row justify-content-center align-items-center position-relative ">

                <div class="container position-absolute p-4" style="top:80px;">
                    <div class="d-flex flex-row justify-content-end mb-2 p-3 top-10 left-50">
                        <button type="button"
                                class="btn btn-lg btn-primary position-relative justify-sm-content-center align-items-sm-center"
                                style="margin-right: 20px;">
                            Stock report
                            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                              <span class="visually-hidden">New alerts</span>
                            </span>
                        </button>

                        <button type="button" class="btn btn-lg btn-primary position-relative">
                            upcoming expiring items
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                              99+
                              <span class="visually-hidden">unread messages</span>
                            </span>
                        </button>
                    </div>

                    <div class=" justify-content-center align-items-center mt-5">
                            <div id="mainMenu" class="d-flex flex-lg-row flex-sm-column btn-group btn-group-lg" role="group" aria-label="Large button group">
                                <button type="button" onclick="window.location.href='/dashboard/stocks'" class="btn btn-outline-primary p-3 m-2 ft" style="min-width:10vw;">Stocks</button>
                                <button type="button" onclick="window.location.href='/dashboard/suppliers'" class="btn btn-outline-primary p-3 m-2" style="min-width:10vw;">Suppliers</button>
                                <button type="button" onclick="window.location.href='/dashboard/payments'" class="btn btn-outline-primary p-3 m-2" style="min-width:10vw;" >Payments</button>
                                <button type="button" onclick="window.location.href='/dashboard/expired'" class="btn btn-outline-primary p-3 m-2" style="min-width:10vw;" >Check Expiring</button>
                            </div>
                    </div>

                    <div class="d-flex flex-row justify-content-center align-items-center mt-3">
                        <div class="card m-3">
                            <div class="card-header text-center ">
                                <div class="text-success h3">PAYMENTS</div>
                            </div>
                            <div class="card-body d-flex flex-column justify-content-evenly"
                                 style="width:20vw; min-height: 25vh;">
                                <h5 class="card-title text-center">Payment management </h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional
                                    content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                        <div class="card m-3">
                            <div class="card-header text-center ">
                                <div class="text-success h3">SUPPLIERS</div>
                            </div>
                            <div class="card-body d-flex flex-column justify-content-evenly"
                                 style="width:20vw; min-height: 25vh;">
                                <h5 class="card-title text-center">Recent suppliers from latest stock</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional
                                    content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                        <div class="card m-3 ">
                            <div class="card-header text-center">
                                <div class="text-success h3">PNL</div>
                            </div>
                            <div class="card-body d-flex flex-column justify-content-evenly"
                                 style="width:20vw; min-height: 25vh;">
                                <h5 class="card-title text-center ">Monthly report</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional
                                    content.</p>
                                <a href="#" class="btn btn-primary ">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/dashboard.js"></script>
</body>
</html>