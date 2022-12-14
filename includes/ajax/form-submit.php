<?php 

require_once('../config.php');
require_once('../session_manage.php');

if(isset($_POST['login'])){

    $data = $_POST;

    $loginCheck = $Main->login($data);
        
    if($loginCheck['status'] == true){
    
        $response = array(
            'type' => 'success',
            'title' => 'Login',
            'msg' => 'You have successfully logged in.',
            'url' => './',
        );
    
    }
    else{
        $response = array(
            'type' => 'error',
            'title' => 'Login Failed',
            'msg' => $loginCheck['msg'],
            'url' => false,
        );
    }
    
    echo json_encode($response);

}

// Validated Users Sub

if(isset($_SESSION['user_id'], $_SESSION['access'], $_POST['validate'])){

    if(hash_equals($CSRF, $_POST['validate'])) {

        unset($_POST['validate']);

        if(isset($_POST['addCustomer'])){

            unset($_POST['addCustomer']);

            $response = $Main->createCustomer($_POST);
        }

        if(isset($_POST['updateCustomer'])){

            $customerID = $_POST['id'];

            unset($_POST['updateCustomer'], $_POST['id']);

            $userData = $_POST;

            $response = $Main->updateCustomer($customerID, $_POST);
        }
        
    }
    else{

        $response = array(
            'type' => 'error',
            'title' => 'Validation Failed',
            'msg' => 'We where unable to verify you request',
            'url' => false
        );

    }

    if(!isset($response)){
        $response = array(
            'type' => 'error',
            'title' => 'Invalid Request',
            'msg' => 'Unable to process your request',
            'url' => './'
        );
    }

    echo json_encode($response);

}

?>