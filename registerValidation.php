<?php

#Generate General Dashboard
/*	echo("<!DOCTYPE html>
<html lang=\"en\">
  <head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Open Source Homework Template</title>

    <!-- Bootstrap -->
    <link href=\"css/bootstrap.min.css\" rel=\"stylesheet\">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src=\"https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js\"></script>
      <script src=\"https://oss.maxcdn.com/respond/1.4.2/respond.min.js\"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href=\"carousel.css\" rel=\"stylesheet\">
  </head>
  <body>


<!-- Sign in bar -->
<nav class=\"navbar navbar-inverse navbar-fixed-top\">
      <div class=\"container\">
        <div class=\"navbar-header\">
          <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#navbar\" aria-expanded=\"false\" aria-controls=\"navbar\">
            <span class=\"sr-only\">Toggle navigation</span>
            <span class=\"icon-bar\"></span>
            <span class=\"icon-bar\"></span>
            <span class=\"icon-bar\"></span>
          </button>
          <a class=\"navbar-brand\" href=\"index.php\">OS Homework</a>
        </div>
        <div id=\"navbar\" class=\"navbar-collapse collapse\">

	<!-- navbar in the header -->
	<ul class=\"nav navbar-nav\">
		<li class=\"dropdown\">
			<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">
			   Learn<b class=\"caret\"></b>
			</a>
			<ul class=\"dropdown-menu\">
			   <li><a href=\"introjava.php\">Introductory Java</a></li>
			   <li><a href=\"#\">Introductory C++</a></li>
			   <li><a href=\"#\">Digital Design Fundamentals</a></li>
			   <li class=\"divider\"></li>
			   <li><a href=\"#\">Assembly and Computer Organization</a></li>
			<li><a href=\"#\">Algorithms and Data Structures</a></li>
			<li><a href=\"#\">Compilers and Programming Languages</a></li>
			   <li class=\"divider\"></li>
			   <li><a href=\"#\">Discrete Math Structures</a></li>
			<li><a href=\"#\">Statistics and Probability</a></li>
			<li><a href=\"#\">Linear Algebra</a></li>
			</ul>
		</li>
		<li><a href=\"#\">Collab</a></li> <!--  class=\"active\" will make it so that the current page label is seleced. -->
		<!-- <li><a href=\"register.html\">Practice</a></li> Coming Soon -->
		<li><a href=\"#\">About Us</a></li> 
	</ul>

	  <form class=\"navbar-form navbar-right\">
  </form>
	</div><!--/.navbar-collapse -->
  </div>
</nav>");
	#-------------------
	*/
	
		

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
		$registerMessage = "";
		$email = "";
		$password = "";
		$confirmPass = "";
		$username = "";
		$emailERR = $passwordERR = $confirmPassERR = "";
		//If username is valid and not in database already
		$isUsernameValid = true;	
		//If email is valid and not in database already
		$isEmailValid = true;	
	#-------------------	
	

	
	
	#Grab and Validate Username	
		$username = test_input($_POST["username"]);						
		//Select the usernames from the user table where the username is equal to the one entered by user
		$queryR = "SELECT username FROM users WHERE username = '$username'";
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
			$email = test_input($_POST["email"]);
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$emailERR = "That doesn't look right, make sure you enter a valid email address.";
			}else{
			
					$sqlEmail = "SELECT email FROM users WHERE email = '$email'";
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
						$isValid = true;
					}
				}
				if(!$isUsernameValid){
					$registerMessage = "<div class=\"container\">
						<div class=\"jumbotron\">
							<br>
								<h1 style=\"margin-left:auto; margin-right:auto;  color: #4A99FF;\">Could not complete registration!</h1>
								<h2>It appears that username already exists with an account.</h2>
								<h2>You entered '<span style=\"color: blue;\">$username</span>' as your username, if this is yours try signing in <a href=\"http://www.opensourcehomework.com/signIn.html\">here</a>!\nIf not go back and choose another email in the register page. </h2>
						</div>
					</div>
					";
		
				}
				
		#-------------------	
	
	
	
		#If email is also valid create user, send email confirmation
		
			if($isEmailValid == true and $isUsernameValid == true){
			
				#Get password and password Confirm
				$password = test_input($_POST["password"]);
				$confirmPass = test_input($_POST["confirmPass"]);
				#-------------------	

				#Encrypt password
				$hashpass = crypt($confirmPass);
				$encrypt = crypt($password, $hashpass);
				#-------------------	

				
				if(password_verify($confirmPass, $encrypt)){
					$sqlCreate = "INSERT INTO users (email, password, status, username) VALUES ('".$email."', '".$encrypt."', 'silver', '".$username."')";
		

					$querySuccess =	mysql_query($sqlCreate);

					if($querySuccess){
						
						
						#Start user session
						session_start();
						$_SESSION["username"] = $username;
						$_SESSION["email"] = $email;
						$_SESSION["status"] = "silver";
						#-------------------	


						#Email confirmation Variable Setup
						$mail = "";
						$msg = "Greetings fellow Object! You have successfully signed up with OpenSourceHomework! Follow the link to start learning: www.opensourcehomework.com\n\nLogin Info:\n Username: $username\n Email: $email\n Password: $password\n Account Status: Silver";
						$sub = "Registration with Opensourcehomework";
						$tfh = "From the TFH Studios team:";
						#-------------------	

						#Attempt Email confirmation
						if( mail($email , $sub , $msg , $tfh) ){
							$mail = "An email has been sent to you with your login information! If you did not receive it, go to your account page and make sure you entered your email correctly! (you can change it there if it is incorrect.) ";
						}
						else{
							$mail = "An error occurred in sending an email to this address: $email .";
						}								
						#-------------------	


						#Inform User Registration is Complete or if there was an error in email confirmation
					$registerMessage = "<!-- Jumbotron / Heading -->
								<div class=\"container\">
									<div class=\"jumbotron\">
										<h1 style=\"margin-left:auto; margin-right:auto;  color: green;\">Registration Complete!</h1>
										<h2>$mail</h2>

									</div>
								</div>"
						;
						#-------------------	

						
					}//END of if $sqlCreate=T
					else{
					$registerMessage = "<!-- Jumbotron / Heading -->
								<div class=\"container\">
									<div class=\"jumbotron\">
										<br>
										<h1 style=\"margin-left:auto; margin-right:auto;  color: #4A99FF;\">Could not complete registration!</h1>
										<h2>Unfortunately you could not connect to our servers database, please come back later and try again.</h2>
									</div>
								</div>"
						;

					}
					
				}//END of if passwordVerify=T
				else{
					$registerMessage = "<!-- Jumbotron / Heading -->
								<div class=\"container\">
									<div class=\"jumbotron\">
									<br>
										<h1 style=\"margin-left:auto; margin-right:auto;  color: #4A99FF;\">Could not complete registration!</h1>
										<h2>Your passwords did not match, go back and re-enter matching passwords.</h2>
									</div>
								</div>"
						;
				}
			
			}//END of if EmailValid=T
			else{
					$registerMessage = "<!-- Jumbotron / Heading -->
								<div class=\"container\">
									<div class=\"jumbotron\">
									<br>
										<h1 style=\"margin-left:auto; margin-right:auto;  color: #4A99FF;\">Could not complete registration!</h1>
										<h2>It appears that email already exists with an account.</h2>
										<h2>You entered '<span style=\"color: blue;\">$email</span>' as your email, if this is yours try signing in <a href=\"http://www.opensourcehomework.com/signIn.html\">here</a>!\nIf not go back and re-enter your correct email in the register page. </h2>
									</div>
								</div>"
						;
			}
		
		#-------------------	


mysql_close($link);
	
	include_once("navBar.php");
		generateNavBar();
		echo($registerMessage);
	include_once("navBar.php");
		generateFooter();
	
	
	
	//Some simple security from xss 
	function test_input($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>