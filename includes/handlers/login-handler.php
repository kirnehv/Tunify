<?php
if(isset($_POST['loginButton'])){
  //Login button was pressed
  $username = $_POST['loginUsername'];
  $password = $_POST['loginPassword'];

  //call function to check is username or password exist
  $result = $account->login($username, $password);
  debug_to_console("About to check");
  if($result == true){
    debug_to_console("Were in");
    //create a session variable to keep track of logged in user throughout pages
    $_SESSION['userLoggedIn'] = $username;
    header("Location: welcome.php");
  }
}
?>
