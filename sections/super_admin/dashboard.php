<?php
$pageTitle = "Customers";

include("includes/ui/page_header.php");

$getCustomers = $mysqli->query('SELECT * FROM customers') or throw new Exception($mysqli->error);

?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

    <h1 class="h2"><?= $pageTitle ?></h1>

    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="?dir=customers&temp=add" class="btn btn-sm btn-primary">Add Customer</a>
        </div>
    </div>

</div>

<div class="table-responsive pt-2">
    <table class="table table-striped table data_tb">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Surname</th>
                <th scope="col">Email</th>
                <th scope="col">City</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($getCustomers as $customer) {
                    echo '
                    <tr>
                        <td>'.$customer['name'].'</td>
                        <td>'.$customer['surname'].'</td>
                        <td>'.$customer['email'].'</td>
                        <td>'.$customer['city'].'</td>
                        <td><a class="btn btn-sm py-0 btn-dark" href="?dir=customers&temp=edit&id='.$customer['id'].'"">View</a></td>
                    </tr>
                    ';
                }
            ?>
        </tbody>
    </table>
</div>

<?php

include("includes/ui/page_footer.php");

?>