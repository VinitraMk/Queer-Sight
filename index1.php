<?php
    ob_start();
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Clean Blog - Start Bootstrap Theme</title>

    <!-- Bootstrap core CSS -->
    <!--<link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">


    <!-- Custom styles for this template -->
    <link href="./css/clean-blog.min.css" rel="stylesheet" type"text/css">

    <script type="text/javascript">
    "use strict";
    function addpost() {
        console.log("entered addpost");
        var ptitle=document.getElementById("title").value;
        var pcont=document.getElementById("content").value;
        var vidurl=document.getElementById("video").value;
        if(ptitle && pcont) {
            console.log("calling ajax "+ptitle+","+pcont);
            $.ajax({
                method:'POST',
                url:'php/add_post.php',
                data:{
                    title:ptitle,
                    cont:pcont,
                    vurl:vidurl,
                },
                dataType:"text",
                success: function (response) {
                    //alert(response);
                }
            });
        }
    }


    setInterval(function() {
        $('#posts').load('php/load_posts.php').fadeIn("slow");
    },1000);
    </script>


  </head>

  <body>
     
  
    <!--Navigation  -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <?php

                                  if(isset($_SESSION["user_logged"])) {
                                      $logged_user=$_SESSION["user_name"];
                                      echo "<li class='nav-item'>
                                                <a class='dropdown-toggle' data-toggle='dropdown' href='#'>".$logged_user."</a>
                                                <span class='caret'></span>
                                                <ul class='dropdown-menu pull-right'>
                                                    <li><a href='#'>Profile</a></li>
                                                </ul>
                                            </li>
                                            <li class='nav-item'>
                                                <a href='php/logout.php'>Logout</a>
                                            </li>";
                                  }
                                  else {
                                      $logged_user="public_user";
                                      echo "<li class='nav-item'>
                                                <a href='login.html'>Login</a>
                                            </li>
                                            <li class='nav-item'>
                                                <a class='nav-link' href='signup.html'>Sign Up</a>
                                            </li>";
                                  }
            ?>

            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!--Page Header 
    <header class="masthead" style="background-image: url('./img/pride-flag.jpeg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <h1>Support Circle</h1>
              <span class="subheading">A Queer Initiative</span>
            </div>
          </div>
        </div>
      </div>
    </header>
-->

    <!--Main Content -->
    <div class="container">
<?php
    if(isset($_SESSION['user_logged'])) {
        echo "<div class='clearfix'>
                <a class='btn btn-primary float-right' href='#' data-toggle='modal' data-target='#postmodal'>Post  &rarr;</a>
              </div>
              <div id='postmodal' class='modal fade' role='dialog'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h4 class='modal-title'>What's in your mind?</h4>
                            <button type='button' class='close' data-dismiss='modal'>&times;</button>
                        </div>
                        <div class='modal-body'>
			<form method='POST' action='' onsubmit=''>
					<div class='form-group'>
						<label for='title'>Title</label>
						<input id='title' type='text' class='form-control' name='title' value='' required autofocus>
					</div>

					<div class='form-group'>
						<label for='content'>Content
						</label>
						<input id='content' type='text' class='form-control' name='content' style='height:20vh;' required data-eye>
					</div>

					<div class='form-group'>
						<label for='video'>Video Url
						</label>
						<input id='video' type='text' class='form-control' name='video' placeholder='Paste only youtube url here..' required data-eye>
					</div>

					<div class='form-group no-margin'>
						<button type='submit' class='btn btn-primary btn-block' name='post' onclick='addpost()'>
						    Post	
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>            
		";

    }
            
?>

      <div class="row">
 
        <div class="col-lg-8 col-md-10 mx-auto" id='posts'>
 
            
        <!-- Pager -->

          </div>
      </div>
    </div>

    <hr>

    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <ul class="list-inline text-center">
              <li class="list-inline-item">
                <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fas fa-circle fa-stack-2x"></i>
                    <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fas fa-circle fa-stack-2x"></i>
                    <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fas fa-circle fa-stack-2x"></i>
                    <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
              </li>
            </ul>
            <p class="copyright text-muted">Copyright &copy; Your Website 2018</p>
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="./js/clean-blog.min.js"></script>

  </body>

</html>

<?php
        #ob_end_flush();
?>
