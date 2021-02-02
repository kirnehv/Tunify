<?php
//retreives album and its elements from db
class Album{

  private $con;
  private $id;
  private $title;
  private $artistId;
  private $genre;
  private $artworkPath;

  //constructor retreives title, artistId, genre, and artworkPath from the db
  public function __construct($con, $id){ //auto called once object created
    $this->con = $con; //set connection equal to variable connection
    $this->id = $id;
    $query = mysqli_query($this->con, "SELECT * FROM albums WHERE id='$this->id'");
    //put result into array $artist
    $album = mysqli_fetch_array($query);

    $this->title = $album['title'];
    $this->artistId = $album['artist'];
    $this->genre = $album['genre'];
    $this->artworkPath = $album['artworkPath'];

  }
  //these functions return title, artistId, genre, and artworkPath when needed
  public function getTitle(){
    return $this->title;
  }
  public function getArtist(){
    return new Artist($this->con, $this->artistId);
  }
  public function getArtworkPath(){
    return $this->artworkPath;
  }
  public function getGenre(){
    return $this->genre;
  }
  public function getNumberOfSongs(){
    $query = mysqli_query($this->con, "SELECT id FROM Songs WHERE album='$this->id'");
    return mysqli_num_rows($query);
  }
  public function getSongIds(){
    $query = mysqli_query($this->con, "SELECT id FROM Songs WHERE album='$this->id'
                          ORDER BY albumOrder ASC");
    $array = array();
    while($row = mysqli_fetch_array($query)){
      array_push($array, $row['id']);
    }
    return $array;
  }
}
?>
