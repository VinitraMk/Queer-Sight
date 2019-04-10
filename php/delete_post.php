<?php
    include("config.php");
    $db=mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    if(isset($db)) {
        if($_POST['post_id']) {
            #echo "Post_id: ".$_POST['post_id'];
            $postid=$_POST['post_id'];
            $sql="DELETE FROM qpost WHERE post_id='$postid'";
            $res=mysqli_query($db,$sql);
            if($res) {
                echo "Successfully deleted the post";
            }
            else {
                echo "Sorry, coudln't delete post :-(";
            }
        }
    }
?>
