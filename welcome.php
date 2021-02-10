<!--top half of the original index...
we do this because every page is going to include the nav side bar AND
the nowPlayingBar-->
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("includes/header.php"); ?>
<!--text on top of albums grid-->
<h1 class="pageHeadingBig">Favorites</h1>
<!--albums grid container-->
<div class="gridViewContainer">
	<?php
		//connect to the database and retreive all albums at random order with a limit of 10
		$albumQuery = mysqli_query($con, "SELECT * FROM albums ORDER BY RAND() LIMIT 10");
		//loop through every row retreieved from db and place in variable $row
		while($row = mysqli_fetch_array($albumQuery)){
			//print the title column of every row of the album table
			//but do it with html(<div>) so we can style it with css
			//this echo prints the artwork and title from every row of the db
			echo "<div class='gridViewItem'>
							<a href='album.php?id=" . $row['id'] . "'>
								<img src='" . $row['artworkPath'] . "'>
								<div class='gridViewInfo'>"
									. $row['title'] .
								"</div>
							</a>
						</div>";
		}
	?>
</div>
<!--bottom half of the original index-->
<?php include("includes/footer.php"); ?>
