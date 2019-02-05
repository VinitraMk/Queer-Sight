<?php
include('config.php');
session_start();
$db=mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

if($db==FALSE) {
    echo "Connection not done";
}
else {
    if(isset($_REQUEST['signup'])) {
        $name=$_POST['name'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        if($password==$cpassword) {
            $sql="INSERT INTO quser(name,email,password) values('$name','$email','$password')";
            $res=mysqli_query($db,$sql);

            if($res==TRUE) {
                //echo "New Record created successfully";
                header('Location: ../welcome.html');
            }
            else {
                echo "Error: ".$sql."<\br>".mysqli_error($db);
            }
        }
    }
    else {
        echo "Not clicked: ";
    }
}

?>

