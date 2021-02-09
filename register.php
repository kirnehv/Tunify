<?php
//include links to php files so be less clunky

  //reference to config.php file to print error message incase
  include("includes/config.php");
  include("includes/classes/Account.php");
  include("includes/classes/Constants.php");

  //create object to access Account class in Account.php file
  $account = new Account($con);//$con is variable that connects to database (config.php)

  include("includes/handlers/register-handler.php");
  include("includes/handlers/login-handler.php");

//get input value and print in text box for user to see their old input after submit
  function getInputValue($name){
    if(isset($_POST[$name])){
      echo $_POST[$name];
    }
  }
?>

<html>
<!--Creates labels, input boxes, input box labels, buttons-->
  <head>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <title>Login</title>
    <!--link register.css file-->
    <link rel="stylesheet" type="text/css" href="assets/css/register.css">
    <!--lets us use javascript-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!--includes register.js file-->
    <script src="assets/js/register.js"> </script>
  </head>
  <body>
    <?php
    //if register button is pressed, hide loginForm and show registerForm
    if(isset($_POST['registerButton'])){
      echo '
      <script>
        $(document).ready(function(){
          $("#loginForm").hide();
          $("#registerForm").show();
        });
      </script>';
    //else if login button is pressed, hide registerForm and show loginForm
    }else{
      echo '
      <script>
        $(document).ready(function(){
          $("#loginForm").show();
          $("#registerForm").hide();
        });
      </script>';
    }
    ?>
    <!--page background that surrounds all the code within it-->
    <div id="background">
      <div class="navbar">
        <a href="#contact">About</a>
        <a href="register.php">Login</a>
        <a href="index.php">Home</a>
      </div>
      <div id="loginContainer">
        <div id="inputContainer">
      		<a href="welcome.php" class="logo">
      			<img src="assets/images/icons/loginIcon.jpg" alt="">
      		</a>
          <!--Login form-->
          <form id="loginForm" action="register.php" method="POST">
            <h2>Log In</h2>
            <p>
              <?php echo $account->getError(Constants::$loginFailed); ?>
              <!-- <label for="loginUsername">Username -->
                <!--we add this value so the username is remembered after first input-->
                <input id="loginUsername" name="loginUsername" type="text" placeholder="Username" value="<?php getInputValue('loginUsername') ?>" required>
              </label>
            </p>
            <p>
              <!-- <label for="loginPassword">Password</label> -->
              <input id="loginPassword" name="loginPassword" type="password" placeholder="Password" required>
            </p>
            <button type="submit" name="loginButton">Login</button>
            <!--hides the Login form-->
            <div class="hasAccountText">
              <br> <span id="hideLogin"> Create an account here</span>
            </div>
          </form>
          <!--Create Account form-->
          <form id="registerForm" action="register.php" method="POST">

            <h2>Create Account</h2>
            <p>
              <!--gets error from Account class with function getError-->
              <?php echo $account->getError(Constants::$usernameCharacters); ?>
              <?php echo $account->getError(Constants::$usernameTaken); ?>
              <?php echo $account->getError(Constants::$emailTaken); ?>
              <!--<label for="username">Username</label> -->
              <input id="username" name="username" type="text" placeholder="Username" value="<?php getInputValue('username') ?>" required>
            </p>
            <p>
              <?php echo $account->getError(Constants::$firstNameCharacters); ?>
              <!-- <label for="firstName">First Name</label> -->
              <input id="firstName" name="firstName" type="text" placeholder="First Name" value="<?php getInputValue('firstName') ?>" required>
            </p>
            <p>
              <?php echo $account->getError(Constants::$lastNameCharacters); ?>
              <!-- <label for="lastName">Last Name</label> -->
              <input id="lastName" name="lastName" type="text" placeholder="Last Name" value="<?php getInputValue('lastName') ?>" required>
            </p>
            <p>
              <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
              <?php echo $account->getError(Constants::$emailInvalid); ?>
              <!-- <label for="email">Email</label> -->
              <input id="email" name="email" type="email" placeholder="Email" value="<?php getInputValue('email') ?>" required>
            </p>
            <p>
              <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
              <?php echo $account->getError(Constants::$emailInvalid); ?>
              <!-- <label for="email2">Confirm Email</label> -->
              <input id="email2" name="email2" type="email" placeholder="Confirm Email" value="<?php getInputValue('email2') ?>"required>
            </p>
            <p>
              <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
              <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
              <?php echo $account->getError(Constants::$passwordCharacaters); ?>
              <!-- <label for="password">Password</label> -->
              <input id="password" name="password" type="password" placeholder="Password" required>
            </p>
            <p>
              <!-- <label for="password2">Confirm password</label> -->
              <input id="password2" name="password2" type="password" placeholder="Password" required>
            </p>
            <button type="submit" name="registerButton">Sign Up</button>
            <!--hides the Create new account form-->
            <div class="hasAccountText">
              <br> <span id="hideRegister"> Have an account? Login here. </span>
            </div>

          </form>
        </div>
        <!--text to the right of login-->
        <!--<div id="loginText">
          <h1>Get great music, right now</h1>
          <h2>Listen to a variety of songs</h2>
          <ul>
            <li>Discover some music you will enjoy</li>
            <li>Upload your own music</li>
            <li>Follow artists of your liking</li>
          </ul>
        </div>-->
      </div>
    </div>
  </body>
</html>
