<?php
if(isset($_POST['loginButton'])){
  //Login button was pressed
  $username = $_POST['loginUsername'];
  $password = $_POST['loginPassword'];

  //call function to check is username or password exist
  $result = $account->login($username, $password);
  echo "<script>console.log('About to check' );</script>";
  if($result == true){
    echo "<script>console.log('Debug Objects: " . $result . "' );</script>";
    //create a session variable to keep track of logged in user throughout pages
    $_SESSION['userLoggedIn'] = $username;
    header("Location: welcome.php");
  }
}
?>
