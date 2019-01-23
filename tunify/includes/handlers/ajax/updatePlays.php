<?php
//configuration file that contains our database file
include("../../config.php");

//sql call
if(isset($_POST['songId'])){
  //retrieve artistId that was passed to the ajax call in nowPlayingBar javascript
  $songId = $_POST['songId'];
  //updates the song table and increments the number of plays
  $query = mysqli_query($con, "UPDATE Songs SET plays = plays + 1 WHERE id='$songId'");

}

?>
