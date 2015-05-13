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
  </head>
  <body>

<!-- Sign in bar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">OS Homework</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">

	<!-- navbar in the header -->
	<ul class="nav navbar-nav">
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			   Learn<b class="caret"></b>
			</a>
			<ul class="dropdown-menu">
			   <li><a href="introjava.html">Introductory Java</a></li>
			   <li><a href="#">Introductory C++</a></li>
			   <li><a href="#">Digital Design Fundamentals</a></li>
			   <li class="divider"></li>
			   <li><a href="#">Assembly and Computer Organization</a></li>
			<li><a href="#">Algorithms and Data Structures</a></li>
			<li><a href="#">Compilers and Programming Languages</a></li>
			   <li class="divider"></li>
			   <li><a href="#">Discrete Math Structures</a></li>
			<li><a href="#">Statistics and Probability</a></li>
			<li><a href="#">Linear Algebra</a></li>
			</ul>
		</li>
		<li><a href="#">Collab</a></li> <!--  class="active" will make it so that the current page label is seleced. -->
		<!-- <li><a href="register.html">Practice</a></li> Coming Soon -->
		<li><a href="#">About Us</a></li> 
	</ul>

	  <form class="navbar-form navbar-right">
		<a href="#"><button type="button" class="btn btn-success">My Account</button></a>
	  </form>
	</div><!--/.navbar-collapse -->
  </div>
</nav>




<!-- Jumbotron / Heading -->
<div class="container">
  <div class="jumbotron">
    <h1 style="margin-left:auto; margin-right:auto;">Registration Page</h1>
    <p>This page will have a place for people to register for an account here.
	This jumbotron will be deleted in the final release.
    </p> 
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
      <form class="form-signin">
        <h2 class="form-signin-heading">Register:</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
	<label for="inputPassword" class="sr-only">Confirm Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Confirm Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Register Now</button>
      </form>
 </div>



<!-- Footer -->
<hr>
<div class="container">
<footer>
   <p>&copy; TFH Studios, LLC. 2015.</p>
</footer>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

 