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
    <link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

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
  
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.html">Home</a>
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

    <!-- Page Header -->
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

    <!-- Main Content -->
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
 
            <!--
          <div class="post-preview">
            <a href="post.html">
              <h2 class="post-title">
                Man must explore, and this is exploration at its greatest
              </h2>
              <h3 class="post-subtitle">
                Problems look mighty small from 150 miles up
              </h3>
            </a>
            <p class="post-meta">Posted by
              <a href="#">Start Bootstrap</a>
              on September 24, 2018</p>
          </div>
          <hr>
          <div class="post-preview">
            <a href="post.html">
              <h2 class="post-title">
                I believe every human has a finite number of heartbeats. I don't intend to waste any of mine.
              </h2>
            </a>
            <p class="post-meta">Posted by
              <a href="#">Start Bootstrap</a>
              on September 18, 2018</p>
          </div>
          <hr>
          <div class="post-preview">
            <a href="post.html">
              <h2 class="post-title">
                Science has not yet mastered prophecy
              </h2>
              <h3 class="post-subtitle">
                We predict too much for the next year and yet far too little for the next ten.
              </h3>
            </a>
            <p class="post-meta">Posted by
              <a href="#">Start Bootstrap</a>
              on August 24, 2018</p>
          </div>
          <hr>
          <div class="post-preview">
            <a href="post.html">
              <h2 class="post-title">
                Failure is not an option
              </h2>
              <h3 class="post-subtitle">
                Many say exploration is part of our destiny, but it’s actually our duty to future generations.
              </h3>
            </a>
            <p class="post-meta">Posted by
              <a href="#">Start Bootstrap</a>
              on July 8, 2018</p>
          </div>
          <hr>
            -->
  
        <!-- Pager -->

<?php
    /*
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

    }*/
            
?>
          </div>
      </div>
    </div>

    <hr>

    <!-- Footer -->
    <!--
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
    -->

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/clean-blog.min.js"></script>

  </body>

</html>

<?php
        ob_end_flush();
?>
