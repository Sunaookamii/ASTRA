<?php
    $path=$_SERVER['DOCUMENT_ROOT'];
    require_once $path."/attendanceapp/database/database.php";
    require_once $path."/attendanceapp/database/facultyDetails.php";
    $action=$_REQUEST["action"];
    if(!empty($action)){
        if($action=="VerifyUser"){
            $un=$_POST["user_name"];
            $pw=$_POST["password"];
            $dbo=new Database();
            $fdo=new faculty_details();
            $fdo->verifyuser($dbo,$un,$pw);
            if($rv['status']=="OKAY"){
                session_start();
                $_SESSION['current_user']=$rv['id'];
            }
            // response
            echo json_encode($rv);
        }
    }
?>