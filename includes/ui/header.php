<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">
    <link href="assets/lib//sweetalerts/sweetalert2.min.css" rel="stylesheet">
    <link href="assets/lib/datatables/datatables.min.css" rel="stylesheet">

    <script src="assets/lib/jquery/jquery.js"></script>

    <title>
        <?php

        if (isset($pageTitle)) {
            echo $pageTitle . ' | ' . SITE_TITLE;
        } 
        else {
            echo SITE_TITLE;
        }
        ?>
    </title>
</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">Basic CRUD</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="logout">Sign out</a>
            </div>
        </div>
    </header>