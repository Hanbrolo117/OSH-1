
      <?php
		session_start();
		$validPassword = true;
		$validEmail = true;

		
		if($_SESSION["email"] != null){
			header('Location: index.php');
		}
		
	if(isset($_POST["signin"])){
	$servername = "localhost";
	$dbUsername = "TFHStudios";
	$dbPassword = "yodabyte";
	$dbname = "UserAccounts";
	
	$conn = mysql_connect($servername, $dbUsername, $dbPassword);
	if(!$conn){
		die('Could not connect: '.mysql_error());
	}
	mysql_select_db($dbname, $conn);

				
				
	//Initially set to a blank string
	$email = $password = $passCrypt = "";
	$emailERR = $passwordERR = "";
		
	$email = test_input($_POST["email"]);
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$emailERR = "That doesn't look right, make sure you enter a valid email address.";
	}
	
	$password = test_input($_POST["password"]);
	$passCrypt = crypt($password);
	
	$sql1 = "SELECT password FROM users WHERE email = '$email'";
	$fetch = mysql_query($sql1);
	$num = mysql_num_rows($fetch);
	$encrypt;
	$victory;
	if($num>0){
	$encrypt = mysql_fetch_object($fetch);    
    #echo($fetch);
    #var_dump($encrypt);
	#echo($encrypt->password);
	$victory = $encrypt->password;
	#echo($victory);
	
	if(password_verify($password, $victory)){
		$_SESSION["email"] = $email;
		
		header('Location: index.php');
		#exit();
	}
	else{
		$validPassword = false;

	}
		}
		else{
		$validEmail = false;
	}	
	
}
	//Some simple security from xss 
	function test_input($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Open Source Homework Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
	.tab-item{background-color:#99CCFF; text-align:center;  border-radius:5px; radius:10px; height:40%; min-height:40px;}
	.tab-item p{padding-top:5%; font-size:120%;}
    </style>
       		<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
       		<script type="text/javascript" src="js/jquery.interactive_bg.js"></script>

  </head>
  <style >
	  body{
		  background-image: url(images/cloud.png);
		  background-repeat:repeat-y;
		  background-size: 100%;
		  overflow: auto;
	  }
	  
	  form{
		  background-color:rgba(255, 255, 255, 0.81);
		  border-radius: 25px;
		  padding: 15px 25px 54px 25px
	  }


	  </style>
	  
	<script>
	  $(document).ready(function(){
       $(".bg").interactive_bg();
       $("#btns").interactive_bg({
         strength: 25,
         scale: 1,
         contain: false,
         wrapContent: true
       });
		});

		$(window).resize(function() {
		  $(".wrapper > .ibg-bg").css({
		    width: $(window).outerWidth(),
		    height: $(window).outerHeight() + 50
		  })
		})

	  </script>
	  
	  
  <body >

         <a href="index.html"><button style="position: absolute; left: 20px; top: 20px; width:90px;
											 z-index: 5;" type="button" class="btn btn-lg btn-primary btn-block" type="submit">DEMO</button></a>


	<div style="position: fixed; z-index: ; background-image: url(images/webback.png); top:0px; background-repeat: no-repeat; background-position:center top; width: 100%; height: 100%; "></div>
	
	
	
	<div class="wrapper bg" data-ibg-bg="images/webfront.png"  style="position: fixed;  height: 100%;  width: 100%; background-repeat: no-repeat; ">
	
	<div class=" ibg-bg" style=" width: 100%; height: 100%; -webkit-transform: matrix(1, 0, 0, 1, 0, 0); transform: matrix(1, 0, 0, 1, 0, 0); -webkit-transition: transform 100ms linear;  transition: transform 100ms linear; background: url(images/webfront.png)  no-repeat; background-size: 50%; "></div>

    	<script type="text/javascript">
        $(".bg").interactive_bg();
      </script>
      
</div>




<div style="z-index: 10; overflow: visible;">
    <div style="position: absolute; width: 31%; margin-left: 33%; min-width: 250px; float: right; top:100px; padding-bottom: 50px; " class="container">

      <form class="form-signin"  method="post">
        <h2 style="text-align: center;" class="form-signin-heading">Open Source Homework</h2>
		<hr style="color:#000000;">
        	<h3 class="form-signin-heading">struct user{</h3>
	        
        		<label for="inputEmail" class="sr-only">Email address</label>
				<input type="email" id="inputEmail" name ="email" class="form-control" placeholder="Email address" required autofocus>
        
				<label for="inputPassword" class="sr-only">Password</label>
				<input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        <?php
	        if(!$validEmail){
				echo(" <h3 style=\"color: #DF4F4F;\">No account exists with that email</h3>  ");
	        }
	        elseif(!$validPassword){
				echo(" <h3 style=\"color: #DF4F4F;\">Invalid password</h3>  ");
		        
	        }
        ?>
			<h3  class="form-signin-heading">};</h3>

			<div class="checkbox">
				<label>
					<input type="checkbox" value="remember-me"> Remember me
				</label>
			</div>
         
			<div class="col-md-6"><button class="btn btn-lg btn-primary btn-block" name="signin" type="submit">Sign in</button></div>
			<a href="register.php"><div class="col-md-6"><button style="padding: 10px; background-color: #DF4F4F; border-color: #DF4F4F;" type="button" class="btn btn-lg btn-primary btn-block" type="submit">Register</button></div></a>

      </form>
      

    
    </div> <!-- /container -->

</div>




    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="BootstrapXL.css">
       
        
<!-- Footer -->
<footer style="position: absolute; bottom: -1px;">
   <p>&copy; TFH Studios, LLC. 2015</p>
</footer>


  </body>
  

</html>



