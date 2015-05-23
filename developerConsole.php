<?php
	session_start();
	if(strcasecmp($_SESSION["status"], "dev") != 0){
		header("Location: index.php");
	}
	
	$email = $_SESSION["email"];
	$status = $_SESSION["status"];

	$videoBool = false;
	$textBool = false;
	$linkBool = false;
	$registrationCom = false;
	
	#Database Connect
	$servername = "localhost";
	$dbUsername = "TFHStudios";
	$dbPassword = "yodabyte";
	$dbname = "UserAccounts";
	
	$conn = mysql_connect($servername, $dbUsername, $dbPassword);
	if(!$conn){
		die('Could not connect: '.mysql_error());
	}
	mysql_select_db($dbname, $conn);
	#-------------------
	

	
	#Query Variable setup
		$devs;
		$vip;
		$silver;
		$gold;
		$users;
		
	#-------------------
	
	
	
	#Database Query
		$query1 = "SELECT status FROM users WHERE status = 'dev'";
		$fetch1 = mysql_query($query1);
		$devs = mysql_num_rows($fetch1);
		
		$query2 = "SELECT status FROM users WHERE status = 'vip'";
		$fetch2 = mysql_query($query2);
		$vip = mysql_num_rows($fetch2);
		
		$query3 = "SELECT status FROM users WHERE status = 'silver'";
		$fetch3 = mysql_query($query3);
		$silver = mysql_num_rows($fetch3);
		
		$query4 = "SELECT status FROM users WHERE status = 'gold'";
		$fetch4 = mysql_query($query4);
		$gold = mysql_num_rows($fetch4);
		
		$query5 = "SELECT email FROM users WHERE 1 ";
		$fetch5 = mysql_query($query5);
		$users = mysql_num_rows($fetch5);
		
		
	
	#-------------------

	
		if(isset($_POST["myAccount"])){
		  	header('Location: myAccount.php');
		}
		elseif(isset($_POST["signOut"])){
			session_unset();
			session_destroy();
			header('Location: signIn.php');
		
		}
		
		elseif(isset($_POST["textfile"])){
			$textBool = true;
			$videoBool = false;
			$linkBool = false;
		}
		elseif(isset($_POST["videofile"])){
			$videoBool = true;
			$textBool = false;
			$linkBool = false;
		}
		elseif(isset($_POST["linkfile"])){
			$linkBool = true;
			$videoBool = false;
			$textBool = false;
		}
		elseif(isset($_POST["cancel"])){
			$linkBool = false;
			$videoBool = false;
			$textBool = false;
		}
		elseif(isset($_POST["createUser"])){
	#Database Connect
		$servername = "localhost";
		$dbUsername = "TFHStudios";
		$dbPassword = "yodabyte";
		$dbname = "UserAccounts";
	
		//Creating connection
		$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

		//Checking connection
		if($conn->connect_error){
			die("Connection failed: " . $conn->connection_error);
		}

		$link = mysql_connect($servername, $dbUsername, $dbPassword);
		mysql_select_db($dbname, $link);
	#-------------------
	
	
	#Variable setup
		$emailNew = "";
		$password = "";
		$confirmPass = "";
		$usernameNew = "";
		$statusNew = "";
		$emailERR = $passwordERR = $confirmPassERR = "";
		
		$emailNO = false;
		$passwordNO = false;
		$usernameNO = false;
		$queryNO = false;
		$registrationComplete = false;
		//If username is valid and not in database already
		$isUsernameValid = false;	
		//If email is valid and not in database already
		$isEmailValid = false;;	
	#-------------------	
	

	
	
	#Grab and Validate Username	
		$usernameNew = test_input($_POST["username"]);						
		//Select the usernames from the user table where the username is equal to the one entered by user
		$queryR = "SELECT username FROM users WHERE username = '$usernameNew'";
		$resultUsername =  mysql_query($queryR, $link);
		$num_rowsUsername = mysql_num_rows($resultUsername);
		//echo($num_rows);
		//If the query comes up with (should only be at most one because of this very check ) # of rows greater than 0
		//that email already exists in the database.
		if($num_rowsUsername > 0){
			//prevent code from adding user to database.
			$isUsernameValid = false;
			$isEmailValid = false;
			//Instead (the else) warn them this email already exists.
			$emailERR = "";
		}
		else{
			$isUsernameValid = true;
		}
		#-------------------	



		#If username is original, check email with database.
			$emailNew = test_input($_POST["email"]);
			if(!filter_var($emailNew, FILTER_VALIDATE_EMAIL)){
				$emailERR = "That doesn't look right, make sure you enter a valid email address.";
			}else{
				if($isUsernameValid == true){
			
					$sqlEmail = "SELECT email FROM users WHERE email = '$emailNew'";
					$resultEmail =  mysql_query($sqlEmail, $link);
					$num_rowsEmail = mysql_num_rows($resultEmail);
					//echo($num_rows);
					//If the query comes up with (should only be at most one because of this very check ) # of rows greater than 0
					//that email already exists in the database.
					if($num_rowsEmail > 0){
						//prevent code from adding user to database.
						$isEmailValid = false;
						//Instead (the else) warn them this email already exists.
						$emailERR = "";
					}
					else{
						$isEmailValid = true;
					}
				}//END of if username=T
				else{
					$isEmailValid = false;
					$usernameNO = true;		
				}
			}		
		#-------------------	
	
	
	
		#If email is also valid create user, send email confirmation
			if($isEmailValid == true){
			
				#Get password and password Confirm
				$password = test_input($_POST["password"]);
				$confirmPass = test_input($_POST["confirmPass"]);
				#-------------------	

				#Encrypt password
				$hashpass = crypt($confirmPass);
				$encrypt = crypt($password, $hashpass);
				#-------------------	

				
				if(password_verify($confirmPass, $encrypt)){
					$sqlCreate = "INSERT INTO users (email, password, status, username) VALUES ('".$emailNew."', '".$encrypt."', 'silver', '".$usernameNew."')";
		

					$querySuccess =	mysql_query($sqlCreate);

					if($querySuccess){
						$statusNew = test_input($_POST["userstatus"]);

						#Email confirmation Variable Setup
						$mail = "";
						$msg = "Greetings fellow Object! You have been successfully signed up with OpenSourceHomework by a Developer who knows you! Follow the link to start learning: www.opensourcehomework.com\n\nLogin Info:\n Username: $usernameNew\n Email: $emailNew\n Password: $password\n Account Status: $statusNew";
						$sub = "Registration with Opensourcehomework";
						$tfh = "From the TFH Studios team:";
						#-------------------	

						#Attempt Email confirmation
						if( mail($emailNew , $sub , $msg , $tfh) ){
							$mail = "An email has been sent to you with your login information! If you did not receive it, go to your account page and make sure you entered your email correctly! (you can change it there if it is incorrect.) ";
						}
						else{
							$mail = "An error occurred in sending an email to this address: $emailNew.";
						}								
						#-------------------	


						#Inform User Registration is Complete or if there was an error in email confirmation
							$registrationComplete = true;
						
						#-------------------	

						
					}//END of if $sqlCreate=T
					else{
						$queryNO = true;
						$isEmailValid = false;

					}
					
				}//END of if passwordVerify=T
				else{
					$passwordNO = true;
					$isEmailValid = false;

				}
			
			}//END of if EmailValid=T
			else{
				$emailNO = true;
				$isEmailValid = false;

			}
		
		#-------------------	


		mysql_close($link);
		}
		
		
	function test_input($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
?>

<?php
	include_once("navBar.php");
	generateNavBar();
?>





<!-- Jumbotron / Heading -->
         <h2 style="text-align: center; color: #007CE5; padding-top: 50px; padding-bottom: 10px;" class="form-signin-heading">Developer Console</h2>
<div class="container col-lg-12">

  <div class="jumbotron ">
	  		         <h3 style="text-align: left; padding: 10px; " class="form-signin-heading">Tutor Content Upload</h3>

	  
      <form style="padding: 10px;" class="form " action="" method="post">
				<div style="padding-top: 20px;"></div>
			
			Choose File type to upload:
			<div style="padding-top: 20px;"></div>

			<div style="padding: 4px;" class="col-md-4"><button class="btn btn-lg btn-primary btn-block" name="textfile" type="submit">Text</button></div>

			<!--<div style="padding-top: 20px;"></div>-->

			<div style="padding: 4px;" class="col-md-4"><button class="btn btn-lg btn-primary btn-block" name="videofile" type="submit">video</button></div>
			<!--<div style="padding-top: 20px;"></div>-->

			<div style="padding: 4px"; class="col-md-4"><button class="btn btn-lg btn-primary btn-block" name="linkfile" type="submit">link</button></div>
      </form>
				<div style="padding-top: 20px;"></div>
				<?php

						if($videoBool == true){
							$videoBool = false;
							echo('
				<form  class="form " action="" method="post">

				Upload Video:
				
					<div style="padding-top: 20px;"></div>

				<input type="file" accept="application/mp4"  id="file" name="videoFile" class="form-control" placeholder="video file" required>
					
					<div style="padding-top: 20px;"></div>
					
<select name="subject">
  <option value="Intro Java">IntroJava</option>
  <option value="IntroC++">IntroC++</option>
  <option value="DigitalDesign">DigitalDesign</option>
  <option value="Assem&CompOrg">Assem&CompOrg</option>
  <option value="Alg$DataStruct">Alg$DataStruct</option>
  <option value="Compilers&ProLang">Compilers&ProLang</option>
  <option value="DiscreteMath">DiscreteMath</option>
  <option value="Stats&PROB">Stats&PROB</option>
  <option value="LinAlgebra">LinAlgebra</option>
</select>					
					<div style="padding-top: 20px;"></div>

				<input type="text" id="til" name="title" class="form-control" placeholder="Title of video/ID" required>

					<div style="padding-top: 20px;"></div>
				
				<div style="padding: 4px; class="col-md-12"><button class="btn btn-lg btn-primary btn-block" name="uploadFile" type="submit">Upload</button></div>

					<div style="padding-top: 20px;"></div>
				
				</form>
				<form style="padding-bottom: 10px;" class="form col-md-12" action="" method="post">

				<div style="padding: 4px; class="col-md-12"><button class="btn btn-lg btn-primary btn-block" name="cancel" type="submit">Cancel Upload</button></div>
				</form>
');
						}
						elseif($textBool == true){
							$textBool = false;
							echo('
				<form class="form " action="" method="post">

				Upload Text File:

					<div style="padding-top: 20px;"></div>

				<input type="file" accept="application/pdf, application/txt" id="file" name="textFile" class="form-control" placeholder="text file" required>
					
					<div style="padding-top: 20px;"></div>
					
<select name="subject">
  <option value="Intro Java">IntroJava</option>
  <option value="IntroC++">IntroC++</option>
  <option value="DigitalDesign">DigitalDesign</option>
  <option value="Assem&CompOrg">Assem&CompOrg</option>
  <option value="Alg$DataStruct">Alg$DataStruct</option>
  <option value="Compilers&ProLang">Compilers&ProLang</option>
  <option value="DiscreteMath">DiscreteMath</option>
  <option value="Stats&PROB">Stats&PROB</option>
  <option value="LinAlgebra">LinAlgebra</option>
</select>					
					<div style="padding-top: 20px;"></div>

				<input type="text" id="til" name="title" class="form-control" placeholder="Title of text/ID" required>

					<div style="padding-top: 20px;"></div>
				
				<div style="padding: 4px;" class="col-md-12"><button class="btn btn-lg btn-primary btn-block" name="uploadFile" type="submit">Upload</button></div>

					<div style="padding-top: 20px;"></div>
				
				</form>
				<form style="padding-bottom: 10px;" class="form col-md-12" action="" method="post">
				
				<div style="padding: 4px;" class="col-md-12"><button class="btn btn-lg btn-primary btn-block" name="cancel" type="submit">Cancel Upload</button></div>
				</form>
');
						
						}
						elseif($linkBool == true){
							$linkBool = false;
				echo('
				
				<form class="form " action="" method="post">

				Setup link:
					
					<div style="padding-top: 20px;"></div>

				<input type="text" id="lil" name="link" class="form-control" placeholder="Link" required>

					<div style="padding-top: 20px;"></div>
					
<select name="subject">
  <option value="Intro Java">IntroJava</option>
  <option value="IntroC++">IntroC++</option>
  <option value="DigitalDesign">DigitalDesign</option>
  <option value="Assem&CompOrg">Assem&CompOrg</option>
  <option value="Alg$DataStruct">Alg$DataStruct</option>
  <option value="Compilers&ProLang">Compilers&ProLang</option>
  <option value="DiscreteMath">DiscreteMath</option>
  <option value="Stats&PROB">Stats&PROB</option>
  <option value="LinAlgebra">LinAlgebra</option>
</select>					
					<div style="padding-top: 20px;"></div>

				<input type="text" id="til" name="title" class="form-control" placeholder="Title of Link/ID" required>

					<div style="padding-top: 20px;"></div>
				
				<div style="padding: 4px; class="col-md-12"><button class="btn btn-lg btn-primary btn-block" name="uploadFile" type="submit">Upload</button></div>
				
				</form>
				<form style="padding-bottom: 10px;" class="form col-md-12" action="" method="post">
				
				<div style="padding: 4px; class="col-md-12"><button class="btn btn-lg btn-primary btn-block" name="cancel" type="submit">Cancel Upload</button></div>
				</form
');
						}
					
				?>
				




  </div>
</div>

		<hr style="color:#000000;">
		         <h2 style="text-align: center; color: #007CE5; padding: 10px; " class="form-signin-heading">Website Analytics</h2>
		<div class="container col-lg-12">
			<div class="jumbotron ">
		         <h3 style="text-align: left; padding: 10px; " class="form-signin-heading">User Status Breakdown</h3>

					<?php 
						echo("Developers: ");
						echo('<br>');
						$devWidth = ($devs / $users) * 100;
						echo('<div style="position: relative; text-align: center; height: 35px; width: '.$devWidth.'%; padding: 8px; border-radius: 8px; background-color: #007CE5;">'.$devs.'</div>');

						echo('<br>');

						echo("VIP Members: ");
						echo('<br>');
						$vipWidth = ($vip / $users ) * 100;
						echo('<div style="position: relative; text-align: center; height: 35px; width: '.$vipWidth.'%; padding: 8px; border-radius: 8px; background-color: #5CB75C;">'.$vip.'</div>');

						echo('<br>');

						echo("Silver Members: ");
						echo('<br>');
						$silverWidth = ($silver / $users ) * 100;
						echo('<div style="position: relative; text-align: center; height: 35px; width: '.$silverWidth.'%; padding: 8px; border-radius: 8px; background-color: #626262;">'.$silver.'</div>');
						
						echo('<br>');
					
						echo("Gold Members: ");
						echo('<br>');
						$goldWidth = ($gold / $users ) * 100;
						echo('<div style="position: relative; text-align: center; height: 35px; width: '.$goldWidth.'%; padding: 8px; border-radius: 8px; background-color: #fff200;">'.$gold.'</div>');
					?> 
				<h3 style="text-align: left; padding: 10px; " class="form-signin-heading">Some other data? Maybe?</h3>

				</div> 
			</div>
		 
		 		<hr style="color:#000000;">
		 		<h2 style="text-align: center; color: #007CE5; padding: 10px; " class="form-signin-heading">User Query</h2>
		<div class="container col-lg-12">
			<div class="jumbotron ">
				<h3 style="text-align: left; padding: 10px; " class="form-signin-heading">
					Maybe later, alot of manual jquery and js required...
				</h3>

				
			</div>
		</div>


		 		<hr style="color:#000000;">
		 		<h2 style="text-align: center; color: #007CE5; padding: 10px; " class="form-signin-heading">Custom User Instantiation</h2>
		<div class="container col-lg-12">
			<div class="jumbotron ">
				
		<form class="form-signin" method="post">        
         	<label  for="username" class="sr-only">Username</label>
        	<input style="padding: 4px;" type="text" id="username" name ="username" class="form-control" placeholder="Username" required>

	        <label  for="inputEmail" class="sr-only">Email address</label>
        	<input style="padding: 4px;" type="email" id="inputEmail" name ="email" class="form-control" placeholder="Email address" required >

			<label for="inputPassword" class="sr-only">Password</label>
			<input style="padding: 4px;" type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
		
			<label for="inputPassword" class="sr-only">Confirm Password</label>
			<input style="padding: 4px;" type="password" id="inputPassword" name="confirmPass" class="form-control" placeholder="Confirm Password" required>
			
			<label  for="userstatus" class="sr-only">Status</label>
        	<input style="padding: 4px;" type="text" id="userstatus" name ="userstatus" class="form-control" placeholder="Status" required>


			
			<button class="btn btn-lg btn-primary btn-block" name="createUser" type="submit">Register Now</button>
      </form>
			<?php
				if($registrationComplete){
					echo("User Registration Complete!");
				}
				else{
					if($emailNO){
						echo("Email ERROR!");	
					}
					elseif($passwordNO){
						echo("Password ERROR!");
					}
					elseif($username){
						echo("Username ERROR!");
					}
					elseif($queryNO){
						echo("Query Insertion ERROR!");
					}
				}
			?>	
			</div>
		</div>

<?php
	include_once("navBar.php");
	generateFooter();
?>

