<?php
//retreives album and its elements from db
class Song{

  private $con;
  private $id;
  private $mysqliData;
  private $title;
  private $artistId;
  private $albumId;
  private $genre;
  private $duration;
  private $path;

  //constructor retreives title, artistId, genre, and artworkPath from the db
  public function __construct($con, $id){ //auto called once object created
    $this->con = $con; //set connection equal to variable connection
    $this->id = $id;
    $query = mysqli_query($this->con, "SELECT * FROM Songs WHERE id='$this->id'");
    //put result into array $artist
    $this->mysqliData = mysqli_fetch_array($query);
    $this->title = $this->mysqliData['title'];
    $this->artistId = $this->mysqliData['artist'];
    $this->albumId = $this->mysqliData['album'];
    $this->genre = $this->mysqliData['genre'];
    $this->duration = $this->mysqliData['duration'];
    $this->path = $this->mysqliData['path'];
  }
  public function getTitle(){
    return $this->title;
  }
  public function getArtist(){
    return new Artist($this->con, $this->artistId);
  }
  public function getAlbum(){
    return new Album($this->con, $this->albumId);
  }
  public function getPath(){
    return $this->path;
  }
  public function getDuration(){
    return $this->duration;
  }
  public function getMysqliData(){
    return $this->mysqliData;
  }
  public function getGenre(){
    return $this->genre;
  }
  public function getId(){
    return $this->id;
  }

}
?>
