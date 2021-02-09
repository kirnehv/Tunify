<?php
//instead if writing session_start() again, we jut reference the config.php file
include("includes/config.php");
include("includes/classes/Artist.php");
include("includes/classes/Album.php");
include("includes/classes/Song.php");

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

//destroys session so youre not logged in (until we create a logout button)
// session_destroy();
debug_to_console("here");
//if user is logged in, enter next page | else, reroute to original page
if(isset($_SESSION['userLoggedIn'])){
	$userLoggedIn = $_SESSION['userLoggedIn'];
	debug_to_console("logged-in");
}else{
	debug_to_console("route");
	// header("Location: index.php");
	// echo "<script> location.replace('index.php'); </script>";
	// die();
}

?>

<html>
<head>
	<link rel="icon" type="image/x-icon" href="../favicon.ico">
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
