<?php
ob_start();
session_start();
include("config.php");

$db=mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
if(isset($db)) {
    echo "<script>console.log('Connected to dp:');</script>";
    $selectposts="SELECT * FROM qpost ORDER BY post_id DESC LIMIT 3";
    $res=mysqli_query($db,$selectposts);
    $count=mysqli_num_rows($res);
    #echo "Res: ".$count;
    $page_content=""; 
    while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)) {
        echo "<script>console.log('Post id: ".$row['post_id']."');</script>";
        $puserid=$row['user_id'];
        $sql="SELECT * FROM quser WHERE user_id='$puserid'";
        $res1=mysqli_query($db,$sql);
        $co1=mysqli_num_rows($res1);
        if($co1==1) {
            $userrow=mysqli_fetch_array($res1,MYSQLI_ASSOC);
            $page_content.="<div class='post-preview'>
            <a href='post.html'>
              <h2 class='post-title'>".$row['title']."
              </h2>
              <h3 class='post-subtitle'>".$row['content']."
              </h3>
            </a>\n";
            if($row['video_url']!="") {
                $turl=$row['video_url'];
                $page_content.="\n<iframe width='320' height='240' src='$turl'?rel=0></iframe>\n";
            }

            $page_content.="<p class='post-meta'>Posted by
              <a href='#'>".$userrow['name']."</a>
              on ".$row['date']."</p>
          </div>";
            if(isset($_SESSION['userid']) && $_SESSION['userid']==$row['user_id']) {
                $onclick_param="deletePost(".$row['post_id'].")";
                #$page_content.="<a href='#' data-target='#deletemodal' data-toggle='modal' style='float:right'>Delete Post</a></br>";
                $page_content.="<a href='#' onclick=$onclick_param style='float:right'>Delete Post</a></br>";

            }
            $page_content.="<hr>";
        }
    }
    echo "".$page_content;
}
else {
    echo "Error connecting to user";
}
?>
