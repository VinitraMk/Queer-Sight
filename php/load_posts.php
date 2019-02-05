<?php
session_start();
include("config.php");

$db=mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
if(isset($db)) {
    #echo "<script>console.log('Connected to dp:');</script>";
    $selectposts="SELECT * FROM qpost ORDER BY date,time DESC LIMIT 3";
    $res=mysqli_query($db,$selectposts);
    $count=mysqli_num_rows($res);
    #echo "Res: ".$row;
    $page_content=""; 
    while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)) {
        $puserid=$row['uid'];
        $sql="SELECT * FROM User WHERE uid='$puserid'";
        $res1=mysqli_query($db,$sql);
        $co1=mysqli_num_rows($res1);
        if($co1==1) {
            $userrow=mysqli_fetch_array($res1,MYSQLI_ASSOC);
            $page_content.="<div class='post-preview'>
            <a href='post.html'>
              <h2 class='post-title'>".$row['ptitle']."
              </h2>
              <h3 class='post-subtitle'>".$row['pcontent']."
              </h3>
            </a>
            <p class='post-meta'>Posted by
              <a href='#'>".$userrow['Name']."</a>
              on ".$row['pdate']."</p>
          </div>
          <hr>";
        }
    }
    echo "".$page_content;
}
else {
    echo "Error connecting to user";
}
?>
