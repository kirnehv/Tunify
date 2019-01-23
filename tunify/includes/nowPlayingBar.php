<?php
//will select 10 songs at random
$songQuery = mysqli_query($con, "SELECT id FROM Songs ORDER BY RAND() LIMIT 10");

$resultArray = array();
//push 10 random songs into $resultArray
while($row = mysqli_fetch_array($songQuery)){
  array_push($resultArray, $row['id']);
}
//converts php variable into json (json can be handled by ANY language)
//$jsonArray now carries out 10 random songs retreived from the db earlier
$jsonArray = json_encode($resultArray);
?>

<script>
  //waits for the page to be completely ready before it starts rendering javascript
  //when the page loads
  $(document).ready(function(){
    //contains our current playlist
    var newPlaylist = <?php echo $jsonArray; ?>;
    audioElement = new Audio();
    //sets the track at the nowPlayingBar
    setTrack(newPlaylist[0], newPlaylist);
    updateVolumeProgressBar(audioElement.audio);

    //resolves highlighting when dragging the progress and volume bars
    $("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove", function(e){
      //prevents the default behavior (highlighting when dragged)
      e.preventDefault();
    });

    //when the mouse is pressed down, itl set mouseDown to true
    $(".playbackBar .progressBar").mousedown(function(){
      mouseDown = true;
    });
    //if the mouse has moved inside the progress bar
    $(".playbackBar .progressBar").mousemove(function(e){
      if(mouseDown == true){
        timeFromOffset(e, this);
      }
    });
    $(".playbackBar .progressBar").mouseup(function(e){
        timeFromOffset(e, this);
    });
    //hover and move volume bar
    $(".volumeBar .progressBar").mousedown(function(){
      mouseDown = true;
    });
    //if the mouse has moved inside the volume bar
    $(".volumeBar .progressBar").mousemove(function(e){
      if(mouseDown == true){
        //percentage calculation
        var percentage = e.offsetX / $(this).width();
        //if its between 1 and 0, set the value to be that
        if(percentage >= 0 && percentage <= 1){
          audioElement.audio.volume = percentage;
        }
      }
    });
    $(".volumeBar .progressBar").mouseup(function(e){
      var percentage = e.offsetX / $(this).width();
      //if its between 1 and 0, set the value to be that
      if(percentage >= 0 && percentage <= 1){
        audioElement.audio.volume = percentage;
      }
    });
    //after the mouse is clicked once, it sets mouseDown to false so it doesnt think
    //the mouse is still being clicked
    $(document).mouseup(function(){
      mouseDown = false;
    });
  });
  //what percentage of the bar have they clicked on..if 50% then calculate 50% of
  //the song and skip to that section
  function timeFromOffset(mouse, progressBar){
    var percentage = mouse.offsetX / $(progressBar).width() * 100;
    var seconds = audioElement.audio.duration * (percentage / 100);
    audioElement.setTime(seconds);
  }

  function prevSong(){
    //if song time is above 3 seconds, set song time back to 0
    if(audioElement.audio.currentTime >= 3 || currentIndex == 0){
      audioElement.setTime(0);
    }else{
      //if song is less than 3 seconds, go to previous song
      currentIndex = currentIndex - 1;
      setTrack(currentPlaylist[currentIndex], currentPlaylist, playSong);
    }
  }
  function nextSong(){
    //if repeat is true (someone clicks repeat button)
    if(repeat == true){
      //set time of current song to 0
      audioElement.setTime(0);
      //play the song
      playSong();
      return;
    }
    //if it is the last song in the playlist, go back to index 0 (first one)
    if(currentIndex == currentPlaylist.length - 1){
      currentIndex = 0;
    //if not the last song go onto the next song
    }else{
      currentIndex++;
    }
    var trackToPlay = shuffle ? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex];
    setTrack(trackToPlay, currentPlaylist, playSong);
  }

  //repeat the song
  function setRepeat(){
    repeat = !repeat;
    //chooses correct repeat icon
    var imageName = repeat ? "repeat_active.png" : "repeat.png";
    $(".controlButton.repeat img").attr("src","assets/images/icons/" + imageName);
  }
  //mute song
  function setMute(){
    audioElement.audio.muted = !audioElement.audio.muted;
    //chooses correct mute icon
    var imageName = audioElement.audio.muted ? "mute.png" : "volume.png";
    $(".controlButton.volume img").attr("src","assets/images/icons/" + imageName);
  }
  //shuffle song
  function setShuffle(){
    shuffle = !shuffle;
    //chooses correct mute icon
    var imageName = shuffle ? "shuffle_active.png" : "shuffle.png";
    $(".controlButton.shuffle img").attr("src","assets/images/icons/" + imageName);
    if(shuffle == true){
      //randomize playlist
      shuffleArray(shufflePlaylist);
      //set index wherever the current playing song index after shuffle is
      //current: a, b, c    b = index 1
      //shuffle:   c, a, b    b = index 2   *if you click next after shuffle, b will play again
      //this line resolves that issue ^
      currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.id);
    }else{
      //shuffle has been deactivated, back to ordered playlist
      currentIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.id);
    }
  }
  //javacript function pulled from the Internet for shuffling the playlist
  function shuffleArray(a) {
    var j, x, i;
    for (i = a.length - 1; i > 0; i--) {
        j = Math.floor(Math.random() * (i + 1));
        x = a[i];
        a[i] = a[j];
        a[j] = x;
    }
  }

  //sets the track to be played at the bottom nowPlayingBar
  function setTrack(trackId, newPlaylist, cb){
    if(newPlaylist != currentPlaylist){
      currentPlaylist = newPlaylist;
      //slice() returns a copy of the array
      shufflePlaylist = currentPlaylist.slice();
      //shuffle the copy of the playlist so we can go back to the ordered playlist
      shuffleArray(shufflePlaylist);
    }
    //if shuffle is activated, set currentIndex to the shufflePlaylist
    if(shuffle == true){
      currentIndex = shufflePlaylist.indexOf(trackId);
    }else{
      //retreives the trackId and grabs the index (0-10) and sets it to currentIndex
      currentIndex = currentPlaylist.indexOf(trackId);
    }
    //before change song, pause the current song
    pauseSong();
    //ajax call used to execute php without the page needed to be reloaded (needed for
    //retreiving songs from the db)
    //we will be referencing the getSongJson.php to retreive the songs from db to use it
    //in this javacript script to play the song
    $.post("includes/handlers/ajax/getSongJson.php", {songId: trackId}, function(data){
      //convert string data into an object so we can use it
      var track = JSON.parse(data);
      //jquery object to display the track title at the nowPlayingBar
      $(".trackName span").text(track.title);
      //another ajax call to retreive artist name
      $.post("includes/handlers/ajax/getArtistJson.php", {artistId: track.artist}, function(data){
        //convert string data into an object so we can use it
        var artist = JSON.parse(data);
        //jquery object to display the artist at the nowPlayingBar
        $(".artistName span").text(artist.name);
      });
      $.post("includes/handlers/ajax/getAlbumJson.php", {albumId: track.album}, function(data){
        //convert string data into an object so we can use it
        var album = JSON.parse(data);
        //jquery object to display the album image at the nowPlayingBar
        $(".albumLink img").attr("src", album.artworkPath);
      });
      //set the track
      audioElement.setTrack(track);
      //play the track
      //playSong();
      if (cb)
        cb();
    });
  }
  //play song and hide play when play is pressed
  function playSong(){
    //use ajax to update the number of plays
    if(audioElement.audio.currentTime == 0){
      $.post("includes/handlers/ajax/updatePlays.php", {songId: audioElement.currentlyPlaying.id});
    }

    $(".controlButton.play").hide();
    $(".controlButton.pause").show();
    audioElement.play();
  }
  //pause song and hide pause when pause is pressed
  function pauseSong(){
    $(".controlButton.play").show();
    $(".controlButton.pause").hide();
    audioElement.pause();
  }

</script>

<div id="nowPlayingBar">
  <div id="nowPlayingLeft">
    <div class="content">
      <span class="albumLink">
        <img src="" class="albumArtwork">
      </span>
      <div class="trackInfo">
        <span class="trackName">
          <span></span>
        </span>
        <span class="artistName">
          <span>Drake</span>
        </span>
      </div>
    </div>
  </div>
  <div id="nowPlayingCenter">
    <div class="content playerControls">
      <div class="buttons">
        <!--title is what appears when mouse hovers over button-->
        <button class="controlButton shuffle" title="Shuffle Button" onclick="setShuffle()">
          <!--alt means if image isnt found, display alt text-->
          <img src="assets/images/icons/shuffle.png" alt="Shuffle">
        </button>
        <button class="controlButton previous" title="Previous Button" onclick="prevSong()">
          <img src="assets/images/icons/previous.png" alt="Previous">
        </button>
        <button class="controlButton play" title="Play Button" onclick="playSong()">
          <img src="assets/images/icons/play.png" alt="Play">
        </button>
        <!--style= is to hide the pause button until the song starts playing-->
        <button class="controlButton pause" title="Pause Button" style="display: none;" onclick="pauseSong()">
          <img src="assets/images/icons/pause.png" alt="Pause">
        </button>
        <button class="controlButton next" title="Next Button" onclick="nextSong()">
          <img src="assets/images/icons/next.png" alt="Next">
        </button>
        <button class="controlButton repeat" title="Repeat Button" onclick="setRepeat()">
          <img src="assets/images/icons/repeat.png" alt="Repeat">
        </button>
      </div>
      <!--takes care of progress bar along with the time-->
      <div class="playbackBar">
        <span class="progressTime current">0.00</span>
        <div class="progressBar">
          <!--progrss bar background-->
          <div class="progressBarBg">
            <!--actual progress of the progress bar-->
            <div class="progress"></div>
          </div>
        </div>
        <span class="progressTime remaining">0.00</span>
      </div>
    </div>
  </div>
  <div id="nowPlayingRight">
    <div class="volumeBar">
      <button class="controlButton volume" title="Volume Button" onclick="setMute()">
        <img src="assets/images/icons/volume.png" alt="Volume">
      </button>
      <div class="progressBar">
        <!--progrss bar background-->
        <div class="progressBarBg">
          <!--actual progress of the progress bar-->
          <div class="progress"></div>
        </div>
      </div>
    </div>
  </div>
</div>
