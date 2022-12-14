<?php 

session_start();

use GlobalFunctions\Main;

define("DB_NAME", "crud");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_SERVER", "localhost");

define("SITE_TITLE", "CRUD Test");
define("SECURITY_KEY", "bbad88c4e92534f6d125c34ecd4133142578d2f512f3867018236b64e2d8cf5a");

/* Tell mysqli to throw an exception if an error occurs */
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

// Check connection
if($mysqli->connect_errno){

    echo "Database connection error";
    exit();

}
else{

    include_once('functions.php');

    $Main = new Main($mysqli);

}

?>