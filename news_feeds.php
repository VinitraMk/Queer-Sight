<!DOCTYPE html>
<?php 
ob_start();
session_start();
?>
<html lang="en">

  <head>

    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Support Circle</title>
	<!-- Bootstrap core CSS -->
	<link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">-->

	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

	<!-- Custom styles for this template -->
	<link href="./css/clean-blog.min.css" rel="stylesheet">


	<!-- Bootstrap core JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<!-- Custom scripts for this template -->
    <script src="./js/clean-blog.min.js"></script>

  </head>

  <body>
	<div class="container" style="margin:2vh;">
            <div class="row">
                <div class="col-md-9">
                    <h1>News Feeds</h1>
                </div>
                <div class="col-md-3">
                    <a href="./index.php"><i class="fa fa-home" aria-hidden="true" style="font-size:48px;float:right;" href="./index.php"></i></a>
                </div>
            </div>
	</div>
    <!--
    <iframe width="400" height="400" style="border:none;" src="http://output11.rssinclude.com/output?type=iframe&amp;id=1211554&amp;hash=ecf009b0ac83cc0a66b5090260af4b3f"></iframe>
-->
        <div class="feeds" style="margin-top:10vh;margin-left:2vw;">
            <?php
            if($_SESSION['profile']['queerty_chk']==1) {
                echo '<div class="feed" style="margin-top:5vh;margin-left:2vw;">
                <script type="text/javascript" src="http://output54.rssinclude.com/output?type=js&amp;id=1211559&amp;hash=e11a94ca2fb645ebdf59c6a9c935ffc1"></script>
                </div>';
            }
            if($_SESSION['profile']['lgbtqn_chk']==1) {
                echo '<div class="feed" style="margin-top:5vh;margin-left:2vw;">
                    <script type="text/javascript" src="http://output19.rssinclude.com/output?type=js&amp;id=1211560&amp;hash=225d34f79faee92a2fa8c0331c9ed763"></script>
                </div>';
            }
            if($_SESSION['profile']['nsn_chk']==1) {
                echo '<div class="feed" style="margin-top:5vh;margin-left:2vw;">
                <script type="text/javascript" src="http://output26.rssinclude.com/output?type=js&amp;id=1211561&amp;hash=cf0c38745bd8d75b4cad9444cbfc9c9c"></script>
                </div>';
            }
            if($_SESSION['profile']['pinkn_chk']==1) {
                echo '<div class="feed" style="margin-top:5vh;margin-left:2vw;">
                    <script type="text/javascript" src="http://output30.rssinclude.com/output?type=js&amp;id=1211562&amp;hash=1698198322140448c74542d5e6538765"></script>
                </div>';
            }
?>
        </div>


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

  </body>

</html>
