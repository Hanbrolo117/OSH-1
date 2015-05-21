<?php
	
		if (!function_exists('generateNavBar')){

function generateNavBar(){
	
		session_start();
	$email = $_SESSION["email"];
	include("navBar.php");
	
			echo('
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
    <!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="carousel.css" rel="stylesheet">
  </head>
  <body>

<style>
	a:link{
		text-decoration: none;
	}
	a:visited{
		text-decoration: none;
	}
	
	</style>
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
          <a class="navbar-brand" href="index.php">OS Homework</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">

	<!-- navbar in the header -->
	<ul class="nav navbar-nav">
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			   Learn<b class="caret"></b>
			</a>
			<ul class="dropdown-menu">
			   <li><a href="introjava.php">Introductory Java</a></li>
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
	  
	  <form class="navbar-form navbar-right" method="post">
		<?php echo "<span style =\"color: #5CB75C; padding-right:5px; \">".$_SESSION["email"]."</span>";?><button type="submit" name="myAccount" class="btn-sm btn-success">Account</button>
<button type="submit" name="signOut" class=" btn-sm btn-success">SignOut</button>	  </form>

	</div><!--/.navbar-collapse -->
  </div>
</nav>

');

}
}




	if (!function_exists('generateFooter'))
	{
		function generateFooter()
		{
			echo '
			<!-- Footer -->
<hr>
<div class="container">
<footer>
   <p>&copy; TFH Studios, LLC. 2015</p>
</footer>
</div>
			</div>
			<!-- jQuery (necessary for Bootstraps JavaScript plugins) -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
			<!-- Include all compiled plugins (below), or include individual files as needed -->
			<script src="js/bootstrap.min.js"></script>
			<script src="js/bootstrap-dialog.js"></script>
			</body>
			</html>';
		}
	}



/*
	"<!DOCTYPE html>
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
	
	
*/



?>