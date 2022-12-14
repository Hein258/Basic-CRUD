<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Crud System</title>
        
        <link href="assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/lib//sweetalerts/sweetalert2.min.css" rel="stylesheet">
        <link href="assets/css/login.css" rel="stylesheet">

        <script src="assets/lib/jquery/jquery.js"></script>
        <script src="assets/lib/sweetalerts/sweetalert2.all.min.js"></script>
        <script src="assets/js/functions.js"></script>
        <script src="assets/js/form-handle.js"></script>
        <script src="assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>

    </head>

    <body class="text-center">

        <main class="form-signin w-100 m-auto">

            <form class="ajax-sub" id="login-form">
                <img class="mb-4" src="assets/images/logo.svg" alt="" width="72" height="57">
                <h1 class="h3 mb-3 fw-normal">Login</h1>

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
                    <label for="floatingInput">Email address</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                    <label for="floatingPassword">Password</label>
                </div>

                <button class="w-100 btn btn-lg btn-primary submit" type="submit">Sign in</button>
                <p class="mt-5 mb-3 text-muted">© 2017 - 2022</p>
            </form>
        
        </main>

    </body>
</html>
