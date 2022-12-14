<?php
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    
    // last request was more than 30 minutes ago
    session_destroy();
            
    header("Location: login");
}
else{
    
    $USER_EMAIL = $_SESSION['user_email'];
    $FULL_NAME = $_SESSION['fullname'];
    $USER_ID = $_SESSION['user_id'];
    $ACCESS = $_SESSION['access'];
    $CSRF = $_SESSION['CSRF_TOKEN'];
}

$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

?>