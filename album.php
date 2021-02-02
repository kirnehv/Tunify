<!--top half of the original index-->
<?php include("includes/header.php");

//retreive id number from selected album
if(isset($_GET['id'])){
  $albumId = $_GET['id'];
}else{
  //redirect to index page is no album is found in db
  header("Location: index.php");
}
//retreive album name
$album = new Album($con, $albumId);
//go to Album.php to retreive artist name
$artist = $album->getArtist();

?>
<!--after an album has been clicked-->
<div class="entityInfo">
  <!--left section will contain the artwork of album-->
  <div class="leftSection">
    <img src="<?php echo $album->getArtworkPath(); ?>">
  </div>
  <!--right section will contain the title of album and artist-->
  <div class="rightSection">
    <h2><?php echo $album->getTitle(); ?></h2>
    <p>By <?php echo $artist->getName(); ?></p>
    <p><?php echo $album->getNumberOfSongs(); ?> songs</p>
  </div>
</div>

<div class="trackListContainer">
  <ul class="trackList">
    <?php
      //retreive song ID
      $songIdArray = $album->getSongIds();
      //tracks the track count (how many songs in the album, leftmost # of the song)
      $i = 1;
      foreach($songIdArray as $songId){
        //$con connects to db and $songId is the id sent to the function to retreive the song
        $albumSong = new Song($con, $songId);
        $albumArtist = $albumSong->getArtist();
        //prints out songs when album is selected, all song rows, numbers them, play button,
        //track name, artist name, more image (3 dots), and duration
        echo "<li class='trackListRow'>
                <div class='trackCount'>
                  <img class='play' src='assets/images/icons/play_orange.png' onclick='setTrack(\"" . $albumSong->getId() . "\", tempPlaylist, playSong)'>
                  <span class='trackNumber'>$i</span>
                </div>

                <div class='trackInfo'>
                  <span class='trackName'>" . $albumSong->getTitle() . "</span>
                  <span class='artistName'>" . $albumArtist->getName() . "</span>
                </div>

                <div class='trackOptions'>
                  <img class='optionsButton' src='assets/images/icons/more.png'>
                </div>

                <div class='trackDuration'>
                  <span class='duration'>" . $albumSong->getduration() . "</span>
                </div>
              </li>";
        //increment track count
        $i++;
      }
    ?>

    <script>
      //convert php variable $songIdArray to json (readable by all languages)
      var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
      //object we can use, tempPlaylist contains the Ids of songs in album page
      tempPlaylist = JSON.parse(tempSongIds);
    </script>

  </ul>
</div>

<!--bottom half of the original index-->
<?php include("includes/footer.php"); ?>
