<?php
//instead if writing session_start() again, we jut reference the config.php file
include("includes/config.php");
include("includes/classes/Artist.php");
include("includes/classes/Album.php");
include("includes/classes/Song.php");

//destroys session so youre not logged in (until we create a logout button)
// session_destroy();

//if user is logged in, enter next page | else, reroute to original page
if(isset($_SESSION['userLoggedIn'])){
	$userLoggedIn = $_SESSION['userLoggedIn'];
}else{
	header("Location: welcome.html");
}

?>

<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<title>Welcome to Tunify!</title>
	<!--link style.css file-->
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<!--jquery hosted by Google-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!--include the javascript file-->
	<script src="assets/js/script.js"></script>
</head>

<body>
	<!--contains all three elements...side navi, center menu, and bottom play bar-->
	<div id="mainContainer">
		<!--topContainer includes the side navi bar and center menu (not bottom play bar)-->
		<div id="topContainer">
			<!--left side navigation bar-->
			<?php include("includes/navBarContainer.php"); ?>
			<div id="mainViewContainer">
				<div id="mainContent">
