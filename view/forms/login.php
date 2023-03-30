<style>
    body {
        background-image: url("#");
        background-size: cover;
        background-repeat: no-repeat;
    }

    .border {
        border: 1px solid black;
    }

    .border_s {
        margin-top: 20vh;
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

<div class="container  p-5 justify-content-center border_s align-items-center">
    <div class="col-12 col-md-12 justify-content-center align-items-center p-5  ">
        <form class="col-12 col-md-12 col-xl-12 justify-content-center align-items-center form bg-white p-5 rounded shadow"
        action="/" method="post">
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
            <input type="hidden" name="csrf-token" value="{{login:csrf-token}}">
            <div class="d-grid gap-2 mx-auto">
                <button class="col-12 btn btn-primary shadow justify-content-center align-items-center" type="submit"
                        style="text-align:center; min-width: 30vh; justify-content: center;">Log in
                </button>
            </div>
        </form>
    </div>

</div>