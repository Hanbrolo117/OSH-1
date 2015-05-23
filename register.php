<?php
	include_once("navBar.php");
	generateNavBarRegister();
?>



<!-- Jumbotron / Heading -->
<div class="container">
  <div class="jumbotron">
    <h1 style="text-align: center;color: #5CB75C ">Registration Page</h1>
    <p style="text-align: center;">Sign up now to start learning a bunch 'o' stuff!</p> 
  </div>
</div>


<!-- Navigation menu -->
<!--
<div class="container">                 
  <ul class="nav nav-tabs nav-justified" role="tablist">
    <li><a href="#">Tutorials</a></li>
    <li><a href="#">Videos</a></li>
    <li><a href="#">Walkthroughs</a></li>
    <li><a href="#">Examples</a></li>        
  </ul>
</div>
-->



<!-- Registration Form -->
 <div style="width:30%; min-width:250px; margin-left:auto; margin-right:auto;">
      <form class="form-signin" action="registerValidation.php" method="post">
        <h2 class="form-signin-heading">User you = new User(</h2>
        
	        <label  for="username" class="sr-only">Username</label>
        	<input  type="text" id="username" name ="username" class="form-control" placeholder="Username" required autofocus>
    
	        <label  for="inputEmail" class="sr-only">Email address</label>
        	<input type="email" id="inputEmail" name ="email" class="form-control" placeholder="Email address" required autofocus>

			<label for="inputPassword" class="sr-only">Password</label>
			<input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
		
			<label for="inputPassword" class="sr-only">Confirm Password</label>
			<input type="password" id="inputPassword" name="confirmPass" class="form-control" placeholder="Confirm Password" required>
			
			<div class="checkbox">
				<label>
					<input type="checkbox" value="remember-me"> Remember me
				</label>
			</div>
			<h2>);</h2>
			<button class="btn btn-lg btn-primary btn-block" type="submit">Register Now</button>
      </form>
 </div>



<?php
	include_once("navBar.php");
	generateFooter();
?>

 