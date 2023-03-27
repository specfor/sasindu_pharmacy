<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">  <!-- Custom CSS -->
  <style>
    body{
        background-image: url("../public/images/background.jpg");
        background-size: cover;
        background-repeat: no-repeat;
    }
    .border {
        border: 5px solid black;
    }
    .border_s{
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
  </style>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <div class="container d-flex flex-column p-1 justify-content-center border_s align-items-center">
    <div class="container p-2">
      <div class="row p-2" style="min-height:95vh">
          <div class="d-flex flex-column col-10 border justify-content-center align-items-center border">
              <h4>Status panel here</h4>
          </div>
          <div class="d-flex flex-column col-2 justify-content-center align-items-center text-center ">
              <div class="btn-group-vertical p-2" role="group" aria-label="Vertical radio toggle button group">
                  <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio1" autocomplete="off" checked>
                  <label class="btn btn-outline-primary p-5" for="vbtn-radio1">MANAGE STOCK</label>
                  <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio2" autocomplete="off">
                  <label class="btn btn-outline-primary p-5" for="vbtn-radio2">CHECK AVAILABILITY</label>
                  <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio3" autocomplete="off">
                  <label class="btn btn-outline-primary p-5" for="vbtn-radio3">PRODUCT REPORT</label>
                  <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio4" autocomplete="off" checked>
                  <label class="btn btn-outline-primary p-5" for="vbtn-radio4">STOCK REPORT</label>
                </div>
          </div>
      </div>
  </div> 

  </div>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>
</body>
