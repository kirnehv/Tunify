<?php
if(isset($_POST['loginButton'])){
  function debug_to_console($data) {
      $output = $data;
      if (is_array($output))
          $output = implode(',', $output);

      echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
  }
  debug_to_console("About to check");
  //Login button was pressed
  $username = $_POST['loginUsername'];
  $password = $_POST['loginPassword'];

  //call function to check is username or password exist
  $result = $account->login($username, $password);
  if($result == true){
    debug_to_console("Were in");
    //create a session variable to keep track of logged in user throughout pages
    $_SESSION['userLoggedIn'] = $username;
    // header("Location: welcome.php");
    echo "<script> location.replace('welcome.php'); </script>";
  }
}
?>
