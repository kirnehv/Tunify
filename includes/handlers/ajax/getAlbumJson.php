<?php
//configuration file that contains our database file
include("../../config.php");

//sql call
if(isset($_POST['albumId'])){
  //retrieve artistId that was passed to the ajax call in nowPlayingBar javascript
  $albumId = $_POST['albumId'];
  //retreives artist from db specified by $artistId
  $query = mysqli_query($con, "SELECT * FROM albums WHERE id='$albumId'");
  //place song into array
  $resultArray = mysqli_fetch_array($query);

  echo json_encode($resultArray);
}

?>
