<?php
//configuration file that contains our database file
include("../../config.php");

//sql call
if(isset($_POST['songId'])){
  //retrieve songId that was passed to the ajax call in nowPlayingBar javascript
  $songId = $_POST['songId'];
  //retreives song from db specified by $songId
  $query = mysqli_query($con, "SELECT * FROM Songs WHERE id='$songId'");
  //place song into array
  $resultArray = mysqli_fetch_array($query);

  echo json_encode($resultArray);
}

?>
