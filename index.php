<?php
include("includes/config.php");

if(isset($_SESSION['user_id'], $_SESSION['access'])){
    
    include("includes/session_manage.php");
    
    switch($_SESSION['access']){
        case 1:
            $userType =  "super_admin";
            break;
            
        case 2:
            $userType =  "admin";
            break;

        default:
            $userType =  "admin";
    }
    
    if(isset( $_GET['temp']) && $_GET['temp'] != "" && !isset( $_GET['dir'])){

        $file = "sections/".$userType."/".$_GET['temp'].".php";

        if(!file_exists($file)){
            $file = "sections/".$userType."/dashboard.php";
        }
        
        include($file);

    }
	elseif(isset($_GET['dir'], $_GET['temp']) && $_GET['dir'] != "" && $_GET['temp'] != ""){

        $file = "sections/".$userType."/".$_GET['dir']."/".$_GET['temp'].".php";
        
        if(!file_exists($file)){
            $file = "sections/".$userType."/dashboard.php";
        }
        
        include($file);
		
	}
	else{
        
        include("sections/".$userType."/dashboard.php");
    }
	
}
else{
    
    session_destroy();
            
	header("Location: login");
    
}

$mysqli->close();

include("includes/ui/footer.php");
