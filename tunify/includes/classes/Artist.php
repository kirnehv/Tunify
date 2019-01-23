<?php
//retreives artist name
class Artist{

  private $con;
  private $id;

  public function __construct($con, $id){ //auto called once object created
    $this->con = $con; //set connection equal to variable connection
    $this->id = $id;
  }
  public function getName(){
    $artistQuery = mysqli_query($this->con, "SELECT name FROM artists WHERE id='$this->id'");
    //put result into array $artist
    $artist = mysqli_fetch_array($artistQuery);
    return $artist['name'];
  }
}
?>
