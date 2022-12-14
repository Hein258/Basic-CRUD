<?php
$pageTitle = "Add Customer";

include("includes/ui/page_header.php");

$getProvinces = $mysqli->query('SELECT * FROM provinces ORDER BY title ASC') or throw new Exception($mysqli->error);

?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

    <h1 class="h2"><?= $pageTitle ?></h1>

</div>

<form class="row g-3 ajax-sub" id="addCustomer-form">

    <div class="col-lg-4">
        <label for="name" class="form-label">Name *</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="col-lg-4">
        <label for="surname" class="form-label">Surname *</label>
        <input type="text" class="form-control" id="surname" name="surname" required>
    </div>

    <div class="col-lg-4">
        <label for="email" class="form-label">Email *</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <div class="col-6">
        <label for="address_1" class="form-label">Address *</label>
        <input type="text" class="form-control" id="address_1" name="address_1" placeholder="1234 Main St" required>
    </div>

    <div class="col-6">
        <label for="address_2" class="form-label">Address 2</label>
        <input type="text" class="form-control" id="address_2" name="address_2" placeholder="Apartment, studio, or floor">
    </div>

    <div class="col-md-6">
        <label for="city" class="form-label">City *</label>
        <input type="text" class="form-control" id="city" name="city" required>
    </div>

    <div class="col-md-4">
        <label for="province" class="form-label">Province *</label>
        <select id="province" class="form-select" name="province" required>
            <option selected disabled>Choose...</option>
            <?php 
                foreach ($getProvinces as $province) {
                    echo '<option value="'.$province['id'].'">'.$province['title'].'</option>';
                }
            ?>
        </select>
    </div>

    <div class="col-md-2">
        <label for="zip" class="form-label">Zip *</label>
        <input type="number" class="form-control" id="zip" name="zip" required>
    </div>

    <div class="col-12">
        <input type="hidden" name="validate" value="<?=  $CSRF ?>">
        <button type="submit" class="btn btn-primary">Add Customer</button>
    </div>

</form>

<?php

include("includes/ui/page_footer.php");

?>