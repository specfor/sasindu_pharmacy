<style>
    body {
        height:100vh;
        background: rgb(26, 123, 218);
        background: linear-gradient(157deg, rgba(26, 123, 218, 0.5802696078431373) 0%, rgba(255, 255, 255, 0.7819502801120448) 34%, rgba(255, 255, 255, 0.7455357142857143) 58%, rgba(26, 123, 218, 0.227328431372549) 100%);
        background-attachment: fixed;
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
    <div class="container mb-5 p-2">
        <div class="row p-2 mb-4 g-2" style="min-height:95vh">
            <div class="d-flex flex-row justify-content-center align-items-center position-relative ">

                <div class="container mb-5 position-absolute p-4" style="top:80px;">
                    <div class="d-flex flex-row justify-content-end mb-2 p-3 top-10 left-50">
<!--                        <button type="button"-->
<!--                                class="btn btn-lg btn-primary position-relative justify-sm-content-center align-items-sm-center"-->
<!--                                style="margin-right: 20px;">-->
<!--                            Stock report-->
<!--                            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">-->
<!--                              <span class="visually-hidden">New alerts</span>-->
<!--                            </span>-->
<!--                        </button>-->

                        <button onclick="window.location.href='/dashboard/expired'" id="upcomingExpireCount" type="button" class="btn btn-lg btn-primary position-relative">
                            upcoming expiring items
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
                                <p class="card-text">Visit payments page to see all about payments.</p>
                                <a href="/dashboard/payments" class="btn btn-primary">Payments</a>
                            </div>
                        </div>
                        <div class="card m-3">
                            <div class="card-header text-center ">
                                <div class="text-success h3">Your Stock Value</div>
                            </div>
                            <div class="card-body d-flex flex-column justify-content-evenly"
                                 style="width:20vw; min-height: 25vh;">
                                <h4 id="stockValue" class="card-title text-center"></h4>
                                <p class="card-text">Visit stock page to know more about your stock and manage it.
                                Keep a look at items about to expire.</p>
                                <a href="/dashboard/stocks" class="btn btn-primary">Stock</a>
                            </div>
                        </div>
                        <div class="card m-3 ">
                            <div class="card-header text-center">
                                <div class="text-success h3">PNL</div>
                            </div>
                            <div class="card-body d-flex flex-column justify-content-evenly"
                                 style="width:20vw; min-height: 25vh;">
                                <h5 class="card-title text-center ">Monthly report</h5>
                                <p class="card-text">Get monthly reports by visiting reports tab.</p>
                                <a href="/dashboard/reports" class="btn btn-primary ">Reports</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/dashboard.js"></script>