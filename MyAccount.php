<?php
	session_start();
	$email = $_SESSION["email"];
	$username =  $_SESSION["username"];
	$status = $_SESSION["status"];

		
		if($_SESSION["email"] == null or $_SESSION["email"] == ""){
			header('Location: mainPage.php');
		}
	
		if(isset($_POST["myAccount"])){
		  	header('Location: myAccount.php');
		}
		elseif(isset($_POST["signOut"])){
			session_unset();
			session_destroy();
			header('Location: signIn.php');
		
		}
	
?>

<?php
	include_once("navBar.php");
	generateNavBar();
?>

<!--MyAccount content here -->
	<div class="container col-lg-12">
		<div class="jumbotron ">
			<h1>Hello there <?php echo $username?>!</h1>
			<h3 style="text-align: left; padding: 10px; " class="form-signin-heading">Account Information</h3>

				
		</div>
	</div>




<?php
	include_once("navBar.php");
	generateFooter();
?>