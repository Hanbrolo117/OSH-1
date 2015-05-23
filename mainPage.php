<?php
	session_start();
	$email = $_SESSION["email"];
	
	$status = $_SESSION["status"];
	if($email == "" or $email == NULL){
		header('Location: index.php');
	}
	
		if(isset($_POST["myAccount"])){
		  	header('Location: myAccount.php');
		}
		elseif(isset($_POST["signOut"])){
			session_unset();
			session_destroy();
			header('Location: index.php');
		
		}
	
?>

<?php
	include_once("navBar.php");
		generateNavBar();
?>





<!-- Jumbotron / Heading -->
<div class="container">
  <div class="jumbotron">


    <h1 style="margin-left:auto; margin-right:auto;">Open Source Homework</h1>
    <p>This site uses Bootstrap
	which is a framework developed by Twitter.  It allows us to develop the
	site quickly in a dynamic and visually appealing manner.  To learn
	this framework quickly, skim through the tutorial on W3Schools and 
	the Bootstrap website, both linked below. 
	<br> <br> This section will be deleted in the final build. The colors and 
	other features can be redesigned after we get a working product.  This should
	allow us to get started and develop a working prototype fairly quickly. 
	<br> I will post a link to the Github repo shortly.  The link will be seen 
	below once I push it to a repo.
	<br> <br>To get an idea of what Bootstrap is capable of, resize this window 
	to fullscreen, half screen, tablet size, and phone size.  It is pretty cool.
    </p> 
	<ul>
	<li><a target="_blank" href="http://www.w3schools.com/bootstrap/">W3Schools Tutorial</a></li>
	<li><a target="_blank" href="http://getbootstrap.com/components/">Bootstrap Components</a></li>
	<li><a target="_blank" href="http://getbootstrap.com/getting-started/#examples">Bootstrap Examples</a></li>
	<li><a target="_blank" href="https://github.com/mhilliker/OSH">Github Repo</a></li>
		<li><a target="_blank" href="signIn.php">Sign in-page link</a></li>
	</ul>
  </div>
</div>


<!-- Navigation menu -->
<!-- Commented out for homepage, but we can use it in other pages.
<div class="container">                 
  <ul class="nav nav-pills nav-justified" role="tablist">
    <li class="active"><a href="#">Home</a></li>
    <li><a href="#">Topic 1</a></li>
    <li><a href="#">Topic 2</a></li>
    <li><a href="#">Topic 3</a></li>        
  </ul>
</div>
-->


<!-- Carousel here -->



<!-- Sample articles -->
<div class="container">
  <div class="row">
    <div class="col-sm-4">
      <h3>Phase 1</h3>
      <p>Front end build. </p>
      <p>We will worry about the small issues/bugs later once we get a working build</p>
    </div>
    <div class="col-sm-4">
      <h3>Phase 2</h3>
      <p>Back end build</p>
      <p>Some will be done during front end build.</p>
    </div>
    <div class="col-sm-4">
      <h3>Phase 3</h3> 
      <p>Add content, make updates/bug fixes.</p>
      <p>Finalize website stuff.</p>
    </div>
  </div>
</div>

<?php
	include_once("navBar.php");
		generateFooter();
?>
