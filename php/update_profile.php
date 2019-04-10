<?php
session_start();
include 'config.php';
$db=mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

function executesql($colname,$val,$userid) {
    $sql1="UPDATE qprofile SET ".$colname."='$val' WHERE user_id='$userid'";
    $res1=mysqli_query($GLOBALS['db'],$sql1);
    if($res1) {
        return True;
    }
    return False;
}

if(isset($db)) {
    if(isset($_REQUEST['update'])) {
        echo "<script>console.log('hi');</script>";
        $email=$_REQUEST['email'];
        $name=$_REQUEST['name'];
        $password="";
        $picture=null;
        $fp=null;
        if(isset($_REQUEST['password']))
            $password=$_REQUEST['password'];


        if(!empty($_FILES["propic"]["name"])) {
            $picture=addslashes(file_get_contents($_FILES["propic"]["tmp_name"]));
        }
        $userid=$_SESSION['userid'];
        $sql="UPDATE quser SET name='".$name."',email='".$email."'";
        echo "".$name.",".$userid.",".$password;
        if(strlen($password)>0)
            $sql.=",password='".$password."'";
        if($picture)
            $sql.=",picture='".$picture."'";
        $sql.=" WHERE user_id='".$userid."'";
        $res=mysqli_query($db,$sql);

        $dob=$_REQUEST['dob'];
        $gender=mysqli_real_escape_string($db,$_REQUEST['gndr_idnty']);
        $pronouns=mysqli_real_escape_string($db,$_REQUEST['pronouns']);
        $orientn=mysqli_real_escape_string($db,$_REQUEST['orientn']);
        $profession=$_REQUEST['profession'];
        $queerty=isset($_REQUEST['queerty_chk']);
        $lgbtq=isset($_REQUEST['lgbtqn_chk']);
        $nsn=isset($_REQUEST['nsn_chk']);
        $pink=isset($_REQUEST['pinkn_chk']);
        $sql1="UPDATE qprofile SET ";
        $upyes=0;
        $res1=null;
        $res1=0;

        if($dob) { 
            if(executesql("dob",$dob,$userid)) 
                $res1|=1;
        }
        if($gender) {
            if(executesql("gndr_idnty",$gender,$userid))
                $res1|=1;
        }
        if($pronouns) {
            if(executesql("pronouns",$pronouns,$userid))
                $res1|=1;
        }
        if($orientn) {
            if(executesql("orientn",$orientn,$userid))
                $res1|=1;
        }
        if($profession) {
            if(executesql("profession",$profession,$userid))
                $res1|=1;
        }

        if($queerty) {
            //echo "<script>console.log('hello: yes queerty');</script>";
            if(executesql("queerty_chk",$queerty,$userid))
                $res1|=1;
        }
        if($lgbtq) {
            if(executesql("lgbtqn_chk",$lgbtq,$userid))
                $res1|=1;
        }
        if($nsn) {
            if(executesql("nsn_chk",$nsn,$userid))
                $res1|=1;
        }
        if($pinkn) {
            if(executesql("pinkn_chk",$pinkn,$userid))
                $res1|=1;
        }

        if($res && $res1) {
            header("Location: ../profile.php");
        }
        else {
            echo "not updated: ".mysqli_error($db);
        }
    }
    else
        echo "error not clicked";
}
