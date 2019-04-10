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

        <?php
            include("./php/config.php");
            $db=mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
            if(isset($db)) {
                $userid=$_SESSION['userid'];
                $selectuser="SELECT * FROM quser WHERE user_id='$userid'";
                $selectprof="SELECT * FROm qprofile WHERE user_id='$userid'";
                $res=mysqli_query($db,$selectuser);
                $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
                $res1=mysqli_query($db,$selectprof);
                $row1=mysqli_fetch_array($res1,MYSQLI_ASSOC);
                $co1=mysqli_num_rows($res);
                $co2=mysqli_num_rows($res1);
                if($co1==1 && $co2==1) {
                    $_SESSION['profile']=$row1;
                    $_SESSION['user_name']=$row['name'];
                    $_SESSION['username']=$row['email'];
                    $_SESSION['profile_pic']=$row['picture'];
                    #header("Location: ../profile.php");
                }
                else {
                    echo "Error: ".mysqli_error($db);
                }
            }

        ?>
         
        <?php
            $profile_dets=$_SESSION['profile'];
            $genders=["-select-","male","female","non_binary","gender_queer","gender_fluid","agender","bigender","trigender","polygender","apathetic","intergender","demigender","gender_non_conforming","two_spirit","questioning"];
            $prons=["ae","e_ey","fae","he","per","she","they","ve","xe","ze_zei"];
            $orientns=["heterosexual","homosexual","bisexual","polysexual","pansexual","asexual","bicurious","grey_asexual","demisexual","androsexual","gynosexual","questioning"];

        ?>

        <script>
            $(document).ready(function() {

                var genders=["-select-","male","female","non_binary","gender_queer","gender_fluid","agender","bigender","trigender","polygender","apathetic","intergender","demigender","gender_non_conforming","two_spirit","questioning"];
            var prons=["-select-","ae","e_ey","fae","he","per","she","they","ve","xe","ze_zei"];
            var orientns=["-select-","heterosexual","homosexual","bisexual","polysexual","pansexual","asexual","bicurious","grey_asexual","demisexual","androsexual","gynosexual","questioning"];

                var gndr="<?php echo $_SESSION['profile']['gndr_idnty'];?>";
                var orientn="<?php echo $_SESSION['profile']['orientn'];?>";
                var pronoun="<?php echo $_SESSION['profile']['pronouns'];?>";
                var queerty="<?php echo $_SESSION['profile']['queerty_chk'];?>";
                var lgbtq="<?php echo $_SESSION['profile']['lgbtqn_chk'];?>";
                var nsn="<?php echo $_SESSION['profile']['nsn_chk'];?>";
                var pinkn="<?php echo $_SESSION['profile']['pinkn_chk'];?>";
                var gndr_ind=genders.indexOf(gndr);
                var orientn_ind=orientns.indexOf(orientn);
                var pronoun_ind=prons.indexOf(pronoun);
                console.log(gndr_ind+","+orientn_ind+","+pronoun_ind);

                document.getElementById("gndr_"+(gndr_ind.toString())).setAttribute("selected","selected");
                document.getElementById("pron_"+(pronoun_ind.toString())).setAttribute("selected","selected");
                document.getElementById("orientn_"+(orientn_ind.toString())).setAttribute("selected","selected");
                if(queerty==1)
                    document.getElementById("queerty_chk").checked=true;
                if(lgbtq==1)
                    document.getElementById("lgbtqn_chk").checked=true;
                if(nsn==1)
                    document.getElementById("nsn_chk").checked=true;
                if(pinkn==1)
                    document.getElementById("pinkn_chk").checked=true;


            });
        </script>


		
		<script>
            function confirm() {
                console.log("keyed");
                if($('#password').val()==$('#cpassword').val()) {
                    console.log("match");
                    $("#message").html("&#10003;");
                    document.getElementById("message").setAttribute("style","visibility:visible;color:green");
                }
                else {
                    console.log("no match");
                    $("#message").html("&#10060;");
                    document.getElementById("message").setAttribute("style","visibility:visible;color:red");
                }
            }
		</script>

	</head>
	<body id="mybody">
        <div class="container" style="margin:2vh;">
            <div class="row">
                <div class="col-md-9">
                    <h1>Edit Profile</h1>
                </div>
                <div class="col-md-3">
                    <a href="./index.php"><i class="fa fa-home" aria-hidden="true" style="font-size:48px;float:right;" href="./index.php"></i></a>
                </div>
            </div>
		  	<hr>
			<div class="row">
			  <!-- left column -->
			  <div class="col-md-3">
                <div class="text-center">
                    <?php
                        if(isset($_SESSION['profile_pic'])) {
                            $picture=$_SESSION['profile_pic'];
                            echo "<img src='data:image/jpeg;base64,".base64_encode($picture)."' class='avatar img-circle' alt='avatar' style='height:200px;width:200px;'/>";
                        }
                        else { 
                            echo "<img src='' class='avatar img-circle' alt='avatar'>";
                        }
                                        
                    ?>
				  <!--<h6 style="margin:1vh;">Upload a different photo...</h6>-->
				  
				  <!--<input type="file" class="form-control" style="margin:auto;" name='propic' id='propic'>-->
				</div>
			  </div>
			  
			  <!-- edit form column -->
			  <div class="col-md-9 personal-info">
				
				<h3>Personal info</h3>
				
				<form class="form-horizontal" method="post" enctype="multipart/form-data" action="./php/update_profile.php">
				  <div class="form-group">
				    <label class="col-lg-3 control-label">Name:</label>
				    <div class="col-lg-8">
                        <input class="form-control" type="text" id='name' name='name' value="<?php echo $_SESSION['user_name'];?>">
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-lg-3 control-label">Email:</label>
				    <div class="col-lg-8">
                    <input class="form-control" type="text" id='email' name='email' value="<?php echo $_SESSION['username'];?>">
				    </div>
				  </div>
				  
				  <div class="form-group">
				    <label class="col-md-3 control-label">Password:</label>
				    <div class="col-md-8">
				      <input class="form-control" type="password" id="password" name='password'>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-md-3 control-label">Confirm password:</label>
				    <div class="col-md-8" id='conpass'>
				      <input class="form-control" type="password" onkeyup="confirm()" id="cpassword" name='cpassword'>
                      <span id="message">&#10003; </span>
				    </div>
                  </div>
                  <div class="form-group" style="margin-top:9vh;">
				    <label class="col-md-3 control-label">Profile Picture:</label>
                    <div class="col-md-8" id='conpass'>
                      <input type="file" class="form-control" style="margin:auto;" name='propic' id='propic'>
				    </div>
				  </div></br>
				  <div class="form-group" style="margin-top:2vh;">
					<label class="col-md-3 control-label">Date Of Birth:</label>
					<div class="col-md-8" id=''>
                        <input id="dob" type="date" class="form-control" name="dob" value="<?php echo $profile_dets['dob'];?>">
					</div>		
					<div class="col-md-12" id=''>
						<input id="disp_age" type="checkbox" name="disp_age" value="1"> Keep my age hidden
					</div>			
				  </div>
				  <div class="form-group" style="margin-top:2vh;">
					<label class="col-md-3 control-label">Gender:</label>
					<div class="col-md-8" id=''>
                      <select id="gndr_idnty" class="form-control" name="gndr_idnty" >
							<option value="" id="gndr_0">-Select-</option>
							<option id="gndr_1" value="male">Male</option>
							<option id="gndr_2" value="female">Female</option>
							<option id="gndr_3" value="non_binary">Non_Binary</option>
							<option id="gndr_4" value="gender_queer">Gender Queer</option>
							<option id="gndr_5" value="gender_fluid">Gender Fluid</option>
							<option id="gndr_6" value="agender">Agender</option>
							<option id="gndr_7" value="bigender">Bigender</option>
							<option id="gndr_8" value="trigender">Trigender</option>
							<option id="gndr_9" value="polygender">Polygender</option>
							<option id="gndr_10" value="apathetic">Gender Apathetic</option>
							<option id="gndr_11" value="intergender">Intergender</option>
							<option id="gndr_12" value="demigender">Demigender</option>
							<option id="gndr_13" value="gender_non_conforming">Gender Non-Conforming</option>
							<option id="gndr_14" value="two_spirit">Two Spirit</option>
							<option id="gndr_15" value="questioning">questioning</option>
                          </select>
					</div>		
					<div class="col-md-12" id=''>
						<input id="disp_gndr" type="checkbox" name="disp_age" value="1"> Keep my gender hidden
					</div>			
				  </div>
				  <div class="form-group" style="margin-top:2vh;">
					<label class="col-md-3 control-label">Pronouns:</label>
					<div class="col-md-8" id=''>
                        <select id="pronouns" class="form-control" name="pronouns">
                            <option id="pron_0" value="">-Select-</option>
							<option id="pron_1" value="ae">Ae/Aer/Aer</option>
							<option id="pron_2" value="e_ey">E/Ey/Em/Eir</option>
							<option id="pron_3" value="fae">Fae/Faer/Faer</option>
							<option id="pron_4" value="he">He/Him/His</option>
							<option id="pron_5" value="per">Per/per/pers</option>
							<option id="pron_6" value="she">She/Her/Her</option>
							<option id="pron_7" value="they">They/Them/Their</option>
							<option id="pron_8" value="ve">Ve/Ver/Vis</option>
							<option id="pron_9" value="xe">Xe/Xem/Xyr</option>
							<option id="pron_10" value="ze_zie">Ze/Zie/Hir/Hir</option>
                        </select>
					</div>				
				  </div>

				  <div class="form-group" style="margin-top:2vh;">
					<label class="col-md-3 control-label">Sexual Orientation:</label>
					<div class="col-md-8" id=''>
                        <select id="orientn" class="form-control" name="orientn">
                            <option id="orientn_0" value="">-Select-</option>
							<option id="orientn_1" value="heterosexual">Heterosexual</option>
							<option id="orientn_2" value="homosexual">Homosexual</option>
							<option id="orientn_3" value="bisexual">Bisexual</option>
							<option id="orientn_4" value="polysexual">Polysexual</option>
							<option id="orientn_5" value="pansexual">Pansexual</option>
							<option id="orientn_6" value="asexual">Asexual</option>
							<option id="orientn_7" value="bicurious">Bicurious</option>
							<option id="orientn_8" value="grey_asexual">Grey Asexual</option>
							<option id="orientn_9" value="demisexual">Demisexual</option>
							<option id="orientn_10" value="androsexual">Androsexual</option>
							<option id="orientn_11" value="gynosexual">Gynosexual</option>
							<option id="orientn_12" value="questioning">questioning</option>
                        </select>
					</div>		
					<div class="col-md-12" id=''>
						<input id="disp_orientn" type="checkbox" name="disp_age" value="1"> Keep my sexual orientation hidden
					</div>			
				  </div>

				  <div class="form-group" style="margin-top:2vh;">
					<label class="col-md-3 control-label">Profession:</label>
					<div class="col-md-8" id=''>
                    <input id="profession" type="text" class="form-control" name="profession" value="<?php echo $profile_dets['profession']; ?>" placeholder="Enter Profession" >
					</div>		
					<div class="col-md-12" id=''>
						<input id="disp_prof" type="checkbox"  name="disp_prof" value="1"> Keep my Profession hidden.
					</div>			
                  </div>

                  <div class="form-group" style="margin-top:2vh;">
                    <label class="col-md-12 control-label">Select the sites for receiving news feeds:</label>
                    <div class="row">
                        <div class="col-lg-6" id=''>
                            <input id="queerty_chk" type="checkbox"  name="queerty_chk" style="margin-left:1vw;">Queerty
                            <input id="lgbtqn_chk" type="checkbox"  name="lgbtqn_chk" style="margin-left:5vw;">LGBTQ Nation
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6" id=''>
                            <input id="nsn_chk" type="checkbox"  name="nsn_chk" style="margin-left:1vw;">No Straight News
                            <input id="pinkn_chk" type="checkbox"  name="pinkn_chk" style="margin-left:2vw;">PinkNews
                        </div>
                    </div>

                  </div>


				  <div class="form-group">
				    <label class="col-md-3 control-label"></label>
				    <div class="col-md-8">
				      <button type="submit" class="btn btn-primary" value="Save Changes" id='update' name='update'>Save Changes</button>
				      <input type="reset" class="btn btn-default" value="Cancel">
				    </div>
                  </div>
                  
                   
				</form>
			  </div>
		  </div>
		</div>
		<hr>
	</body>
</html>

