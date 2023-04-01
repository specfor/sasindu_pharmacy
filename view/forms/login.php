<style>
    body {
        height:100vh;
        background-attachment: fixed;
        background: rgb(26, 123, 218);
        background: linear-gradient(157deg, rgba(26, 123, 218, 0.5802696078431373) 0%, rgba(255, 255, 255, 0.7819502801120448) 34%, rgba(255, 255, 255, 0.7455357142857143) 58%, rgba(26, 123, 218, 0.227328431372549) 100%);
    }

    .border {
        border: 2px solid black;
    }

    .border_s {
        margin-top: 10vh;
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

<div class="container p-5 justify-content-center border_s align-items-center" >
    <div class="col-12 col-md-12 justify-content-center align-items-center ">
        <form class="col-12 col-md-12 col-xl-12 justify-content-center align-items-center form bg-white p-5 rounded shadow"
        action="/" method="post" style="min-width:50px;">
            <h3 class="text-center mb-3">Stock Management System</h3>
            <!-- i want to center this div-->
            <div class="mb-3" style="min-width:150px">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input name="username" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" style="width: 40vh; min-width: 10vh;>
            </div>
            <div class=" mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1"
                       style="width: 40vh; min-width: 10vh;">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Remember me</label>
            </div>
            <div class="d-grid gap-2 mx-auto">
                <button class="col-12 btn btn-primary shadow justify-content-center align-items-center" type="submit"
                        style="text-align:center; min-width: 30vh; justify-content: center;">Log in
                </button>
            </div>
        </form>
    </div>

</div>