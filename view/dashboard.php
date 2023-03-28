<style>
    body{
        background-image: url("images/background.jpg");
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
    @media (max-width: 768px) {
        .aligner {
            width: 100%;
            font-size:10px;
            display: flex;
            flex-direction: column;
        }
        .aligner label {
            width: 100%;
            margin-bottom: 10px;
            text-align:center;
            font-size:10px;
        }
    }
  </style>
  <div class="container d-flex flex-column p-1 justify-content-center border_s align-items-center">
    <div class="container p-2">
      <div class="row p-2" style="min-height:95vh">
          <div class="d-flex flex-column col-sm-10 col-12 border justify-content-center align-items-center border">
              <h4>Status panel here</h4>
          </div>
          <div class="d-flex flex-column col-sm-2 col-12 justify-content-center align-items-center text-center">
              <div class="btn-group-vertical  p-2 text-center justify-content-center align-items-center aligner" role="group" aria-label="Vertical radio toggle button group">
                  <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio1" autocomplete="off" checked>
                  <label class="btn btn-outline-primary p-5" for="vbtn-radio1">MANAGE STOCK</label>
                  <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio2" autocomplete="off">
                  <label class="btn btn-outline-primary p-5" for="vbtn-radio2">CHECK AVAILABILITY</label>
                  <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio3" autocomplete="off">
                  <label class="btn btn-outline-primary p-5" for="vbtn-radio3">PRODUCT REPORT</label>
                  <input type="radio" class="btn-check text-center" name="vbtn-radio" id="vbtn-radio4" autocomplete="off" checked>
                  <label class="btn btn-outline-primary p-5 text-center" for="vbtn-radio4">STOCK REPORT</label>
                </div>
          </div>
      </div>
  </div> 
</div>
