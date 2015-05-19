<?php

	$servername = "localhost";
	$dbUsername = "mrhilliker";
	$dbPassword = "trombone1";
	$dbname = "UserAccounts";
	//Creating connection
	$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

	//Checking connection
	if($conn->connect_error){
		die("Connection failed: " . $conn->connection_error);
	}

	//Initially set to a blank string
	$email = $password = $confirmPass = "";
	$emailERR = $passwordERR = $confirmPassERR = "";
		
	

		//Debugging stuff
		/*
		echo("Test:");
		echo("<br>");
		echo($_POST["email"]);
		echo("<br>");
		echo($_POST["password"]);
		echo("<br>");
		echo($_POST["confirmPass"]);
		*/

				 				
		echo("<!DOCTYPE html>
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
          <a class=\"navbar-brand\" href=\"#\">OS Homework</a>
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
		<a href=\"#\"><button type=\"button\" class=\"btn btn-success\">My Account</button></a>
	  </form>
	</div><!--/.navbar-collapse -->
  </div>
</nav>");
  
  													
		if(empty($_POST["email"])){
			$emailERR = "how will we contact you!?";
		}else{
			$email = test_input($_POST["email"]);
			$sqlEmail = "'".$email."'"; 
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$emailERR = "That doesn't look right, make sure you enter a valid email address.";
			}
				
			
		}
		
		//If email is valid and not in database
		$isValid = true;
		
		//Select the emails from the user table where the email is equal to the one entered by user
				$link = mysql_connect($servername, $dbUsername, $dbPassword);
				mysql_select_db($dbname, $link);
				$sql0 = "SELECT email FROM users WHERE email = '$email'";
				$result =  mysql_query($sql0, $link);
				$num_rows = mysql_num_rows($result);
				//echo($num_rows);
				//If the query comes up with (should only be at most one because of this very check ) # of rows greater than 0
				//that email already exists in the database.
				if($num_rows > 0){
					//prevent code from adding user to database.
					$isValid = false;
					//Instead (the else) warn them this email already exists.
					$emailERR = "";
				}
				else{
					$isValid = true;
				}
		
		//If email is original, add user to database.
		if($isValid == true){
		
		if(empty($_POST["password"])){
			$passwordERR = "do you even want security?";
		}else{
			
			$password = test_input($_POST["password"]);
			
			if(empty($_POST["confirmPass"])){
				$passwordERR = "face it, you are human #Mistakes.";
			}else{
				$confirmPass = test_input($_POST["confirmPass"]);
				$hashpass = crypt($confirmPass);
				//this($encrypt) is saved and when users sign in it will be checked by: 
				//siginPass = crypt($signPass); if(siginPass == $encrypt(from the database of course)){ sign user in }
				$encrypt = crypt($password,$hashpass);
				if(password_verify($confirmPass, $encrypt)){
					
					$sql = "INSERT INTO users (email, password) VALUES ('$email', '$encrypt')";
					
					if($conn->query($sql) === TRUE){
						echo("<h2 style=\" color: green;\">Registration Complete!</h2>");
					}else{
						echo("<h2 style=\" color: red;\" >ERROR: could not complete registration!</h2>");
					}
				}
				else{
					echo("<h2 style=\" color: red;\" >ERROR:passwords do not match!</h2>");
				}
			}
		}	
		
		}
		else{
			echo("<p>That email already exists!<p>");
		}
		$conn-> close();



	//Some simple security from xss 
	function test_input($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	?>
	
