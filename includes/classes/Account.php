<?php
class Account{

  private $con;
  private $errorArray;

  public function __construct($con){ //auto called once object created
    $this->con = $con; //set connection equal to variable connection
    $this->errorArray = array(); //set our error array to an empty array
  }

  public function login($un, $pw){
    $pw = md5($pw); //encrypt password
    // prepare and bind
    $stmt = mysqli_prepare($this->con, "SELECT * FROM users WHERE username=? AND password=?");
    mysqli_stmt_bind_param($stmt, "ss", $un, $pw);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    //check if username or password is correct
    // $query = mysqli_query($this->con, "SELECT * FROM users WHERE username='$un' AND password='$pw'");
    if(mysqli_stmt_num_rows($stmt)==1){
      //if even 1 exists, return true
      return true;
    }else{
      //if either password or username exist in DB, print error and return false
      array_push($this->errorArray, Constants::$loginFailed);
      return false;
    }
  }
  public function register($un, $fn, $ln, $em, $em2, $pw, $pw2){
    array_push($this->errorArray, Constants::$regUnavailable);
    return;
    // $this->validateUsername($un);
    // $this->validateFirstName($fn);
    // $this->validateLastName($ln);
    // $this->validateEmails($em, $em2);
    // $this->validatePasswords($pw, $pw2);
    //
    // if(empty($this->errorArray) == true){ //if there are no errors
    //   //Insert into database
    //   return $this->insertUserDetails($un, $fn, $ln, $em, $pw); //if no errors, call this function to insert userDetails to DB
    // }
    // else{
    //   return false;
    // }
  }

  //checks the error message and checks if it exists in our class
  public function getError($error){
    //if error doesnt exists in array, set $error as empty string
    if(!in_array($error, $this->errorArray)){
      $error = "";
    }
    return "<span class='errorMessage'>$error</span>"; //return html element
  }

  //insert input into database
  private function insertUserDetails($un, $fn, $ln, $em, $pw){
    $encryptedPw = md5($pw); //encrypts password with md5()
    $profilePic = "assets/images/profile-pics/Icon.png"; //grab profile pic from folder
    $date = date("Y-m-d"); //set date format
    //insert data in DB
    $result = mysqli_query($this->con, "INSERT INTO users VALUES (DEFAULT, '$un', '$fn', '$ln', '$em', '$encryptedPw', '$date', '$profilePic')");

    return $result; //returns true or false
  }
  //checks username name length, 5-25 characters
  private function validateUsername($un){
    if(strlen($un) > 25 || strlen($un) < 5){
      array_push($this->errorArray, Constants::$usernameCharacters);
      return;
    }
    //check if username exists in DB, prints error is so
    $checkUsernameQuery = mysqli_query($this->con, "SELECT username FROM users WHERE username='$un'");
    if(mysqli_num_rows($checkUsernameQuery)!=0){
      array_push($this->errorArray, Constants::$usernameTaken);
      return;
    }
  }
  //checks first name length, 2-25 characters
  private function validateFirstName($fn){
    if(strlen($fn) > 25 || strlen($fn) < 2){
      array_push($this->errorArray, Constants::$firstNameCharacters);
      return;
    }
  }
  //checks last name length, 2-25 characters
  private function validateLastName($ln){
    if(strlen($ln) > 25 || strlen($ln) < 2){
      array_push($this->errorArray, Constants::$lastNameCharacters);
      return;
    }
  }
  private function validateEmails($em, $em2){
    if($em != $em2){ //confirms email re-enter
      array_push($this->errorArray, Constants::$emailsDoNotMatch);
      return;
    }
    if(!filter_var($em, FILTER_VALIDATE_EMAIL)){ //checks if .com is used
      array_push($this->errorArray, Constants::$emailInvalid);
      return;
    }
    //checks is email exists, prints error is so
    $checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email='$em'");
    if(mysqli_num_rows($checkEmailQuery)!=0){
      array_push($this->errorArray, Constants::$emailTaken);
      return;
    }

  }
  private function validatePasswords($pw, $pw2){
    if($pw != $pw2){ //checks if passwords match
      array_push($this->errorArray, Constants::$passwordsDoNotMatch);
      return;
    }
    if(preg_match('/[^A-Za-z0-9]/', $pw)){ //if password is NOT ^ A-Z a-z 0-9
      array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
      return;
    }
    if(strlen($pw) > 30 || strlen($pw) < 5){ //check password length
      array_push($this->errorArray, Constants::$passwordCharacaters);
      return;
    }
  }
}
?>
