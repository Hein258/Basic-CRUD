<?php
$pageTitle = "View Customer";

include("includes/ui/page_header.php");

$customerID = $mysqli->real_escape_string($_GET['id']);

$getCustomer = $mysqli->query('SELECT * FROM customers WHERE id = "'.$customerID.'" ') or throw new Exception($mysqli->error);

if($getCustomer->num_rows > 0){

    $customerData = $getCustomer->fetch_assoc();
    
    $getProvinces = $mysqli->query('SELECT * FROM provinces ORDER BY title ASC') or throw new Exception($mysqli->error);

}
else{
    echo '
        <script>
            window.location.href = "./";
        </script>
    ';
}

?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

    <h1 class="h2"><?= $pageTitle ?></h1>

</div>

<div class="row g-3 ajax-sub">

    <div class="col-lg-4">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" value="<?= $customerData['name'] ?>" readonly>
    </div>

    <div class="col-lg-4">
        <label for="surname" class="form-label">Surname</label>
        <input type="text" class="form-control" id="surname" value="<?= $customerData['surname'] ?>" readonly>
    </div>

    <div class="col-lg-4">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" value="<?= $customerData['email'] ?>" readonly>
    </div>

    <div class="col-6">
        <label for="address_1" class="form-label">Address</label>
        <input type="text" class="form-control" id="address_1" placeholder="1234 Main St" value="<?= $customerData['address_1'] ?>" readonly>
    </div>

    <div class="col-6">
        <label for="address_2" class="form-label">Address 2</label>
        <input type="text" class="form-control" id="address_2" placeholder="Apartment, studio, or floor" value="<?= $customerData['address_2'] ?>" readonly>
    </div>

    <div class="col-md-6">
        <label for="city" class="form-label">City</label>
        <input type="text" class="form-control" id="city" value="<?= $customerData['city'] ?>" readonly>
    </div>

    <div class="col-md-4">
        <label for="province" class="form-label">Province</label>
        <?php 
            $province = '';
            foreach ($getProvinces as $province) {

                if($customerData['province'] == $province['id']){
                    $selected = 'selected';
                    $province = $province['title'];
                    break;
                }

            }
        ?>

        <input type="text" class="form-control" id="province" value="<?=$province?>" readonly>
    </div>

    <div class="col-md-2">
        <label for="zip" class="form-label">Zip</label>
        <input type="text" class="form-control" id="zip" value="<?= $customerData['zip'] ?>" readonly>
    </div>

</div>

<?php

include("includes/ui/page_footer.php");

?>