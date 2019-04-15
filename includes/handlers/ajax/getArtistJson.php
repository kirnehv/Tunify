<?php
//configuration file that contains our database file
include("../../config.php");

//sql call
if(isset($_POST['artistId'])){
  //retrieve artistId that was passed to the ajax call in nowPlayingBar javascript
  $artistId = $_POST['artistId'];
  //retreives artist from db specified by $artistId
  $query = mysqli_query($con, "SELECT * FROM artists WHERE id='$artistId'");
  //place song into array
  $resultArray = mysqli_fetch_array($query);

  echo json_encode($resultArray);
}

?>
