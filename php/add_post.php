<?php
session_start();
include("config.php");

$db=mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
if(isset($db)) {
    #echo "<script>console.log('Connected to dp:');</script>";
    if(isset($_SESSION["user_logged"]) && $_POST['title']) {
        #echo "<script>console.log('User logged in')</script>";
        $uid=$_SESSION['userid'];
        $title=$_POST['title'];
        $content=$_POST['cont'];
        $videourl=$_POST['vurl'];
        if(strlen($content)<=500) {
            $tempcontent=mysqli_real_escape_string($db,$content);
            $sql="INSERT INTO qpost(user_id,date,time,title,content,video_url) VALUES('$uid',CURDATE(),CURTIME(),'$title','$tempcontent','$videourl')";
            $res=mysqli_query($db,$sql);
            if($res) {
                echo "<script>console.log('Inserted post')</script>";
            }
            else {
                echo "Error: ".$sql."<\br>".mysqli_error($db);
            }
        }
        else {
            echo "Content length limit exceeded!";
        }

    }
    else {
        echo "Error connecting to user";
    }
}
?>
