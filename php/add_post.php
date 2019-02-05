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
                //echo "<script>console.log('Inserted post')</script>";
				$selectposts="SELECT * FROM qpost ORDER BY date,time DESC LIMIT 3";
				$res=mysqli_query($db,$selectposts);
				$count=mysqli_num_rows($res);
				#echo "Res: ".$row;
				$page_content=""; 
				while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)) {
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
						$page_content.="<hr>";
					}
	    		}
	   	 		echo "".$page_content;
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
