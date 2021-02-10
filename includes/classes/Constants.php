<?php
//variables for error messages
class Constants{
  //register error messages
  public static $passwordsDoNotMatch = "Your passwords don't match";
  public static $passwordNotAlphanumeric = "Your passwords can only contain numbers and letters";
  public static $passwordCharacaters  = "Your password must be between 5 and 30 characters";
  public static $emailInvalid = "Email is invalid";
  public static $emailsDoNotMatch = "Your emails don't match";
  public static $lastNameCharacters = "Your last name must be between 5 and 25 characters";
  public static $firstNameCharacters = "Your first name must be between 5 and 25 characters";
  public static $usernameCharacters = "Your username name must be between 5 and 25 characters";
  public static $usernameTaken = "This username is already exists";
  public static $emailTaken = "This email is already exists";

  //login error messages
  public static $loginFailed = "Your username or password was incorrect";

  // registration not available
  public static $regUnavailable = "Please contact admin for registration";

}

?>
