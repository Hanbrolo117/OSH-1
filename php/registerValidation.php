<?php
	echo(phpversion());
	//Initially set to a blank string
	$email = $password = $confirmPass = "";
	$emailERR = $passwordERR = $confirmPassERR = "";
		
//	$name = "Kyle";
//	$email = "hanbrolo117@gmail.com";
//	$password = "strawberry";
//	$confirmPass = "strawberry";	
	
	////test each input
	//if($_SERVER['REQUEST_METHOD'] == "POST"){
		/*
		if(empty($_POST["name"])){
			$nameERR = "Who are you!?";

		}else{
			$name = test_input($_POST["name"]);
			if(!preg_match("/^[a-zA-Z ]*$/", $name)){
				$nameERR = "only letters and white spaces allowed...\n
				unless of course you are C3-PO or something.";
			}
		}*/
		echo("Test:");
		echo("<br>");
		echo($_POST["email"]);
		echo("<br>");
		echo($_POST["password"]);
		echo("<br>");
		echo($_POST["confirmPass"]);
		
		
		
		if(empty($_POST["email"])){
			$emailERR = "how will we contact you!?";
		}else{
			
			$email = test_input($_POST["email"]);
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$emailERR = "That doesn't look right, make sure you enter a valid email address.";
			}
		}
		
		if(empty($_POST["password"])){
			$passwordERR = "do you even want security?";
		}else{
			
			$password = test_input($_POST["password"]);
			
			if(empty($_POST["confirmPass"])){
				$passwordERR = "face it, you are human #Mistakes.";
			}else{
				$confirmPass = test_input($_POST["confirmPass"]);
				$hashpass = crypt($confirmPass);
				
				if(password_verify($confirmPass, crypt($password,$hashpass))){
					echo("<h2 style=\" color: green;\">Registration Complete!</h2>");
					
				//Database insertion (add user) code here
				}
				else{
					echo("<h2 style=\" color: red;\" >ERROR: could not complete registration!</h2>");
				}
			}
		}	
	//}
	//echo("<br>");
	//echo("UserInfo:");
	//echo($name);
	//echo($email);
	//echo($password);
	//echo($confirmPass);
	//Some simple security from xss 

	function test_input($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	?>
