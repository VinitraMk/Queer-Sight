<?php

include("config.php");
session_start();
$_SESSION['user_logged']=false;
$_SESSION['user_name']="";
$_SESSION['username']="";

$db=mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

if(isset($db)) {
    if(isset($_REQUEST['login'])) {
        $uname=$_POST['email'];
        $password=$_POST['password'];
    
        $sql="SELECT user_id,name from quser WHERE email='$uname' and password='$password'";
        $res=mysqli_query($db,$sql);
        $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
        #$active=$row['active'];
    
        $count=mysqli_num_rows($res);
    
        if($count==1) {
            //session_register("uname");
            $_SESSION['user_name']=$row['name'];
            $_SESSION['user_logged']=true;
            $_SESSION['username']=$uname;
            $_SESSION['userid']=$row['user_id'];
            header("Location: ../index.php");
        }
        else {
            $error="Your Username or Password is invalid";
        }
    }
    
}
else {
    echo "Error";
}



?>





