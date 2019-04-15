var currentPlaylist = [];
var shufflePlaylist = [];
var tempPlaylist = [];
var audioElement;
//used to tell if the mouse has been clicked or not (progress bar)
var mouseDown = false;
var currentIndex = 0;
var repeat = false;
var shuffle = false;
var userLoggedIn;
var timer;

function openPage(url) {
	//if we go to a new page and the timer is going, stop it
	if(timer != null){
		clearTimeout(timer);
	}
	if(url.indexOf("?") == -1) {
		url = url + "?";
	}

	var encodedUrl = encodeURI(url + "&userLoggedIn=" + userLoggedIn);
	console.log(encodedUrl);
	$("#mainContent").load(encodedUrl);
	$("body").scrollTop(0);
	history.pushState(null, null, url);
}

//format the duration (default: seconds)
function formatTime(seconds){
  var time = Math.round(seconds);
  var minutes = Math.floor(time / 60); //rounds down, removes decimal
  var seconds = time - (minutes * 60);
  //add 0 to fill format 00:00
  var extraZero = (seconds < 10) ? "0" : "";

  return minutes + ":" + extraZero + seconds;
}
//update the progressBar time
function updateTimeProgressBar(audio){
  //jquery object
  //updates current time
  $(".progressTime.current").text(formatTime(audio.currentTime));
  $(".progressTime.remaining").text(formatTime(audio.duration-audio.currentTime));

  //calculates percentage for progess bar
  var progress = audio.currentTime / audio.duration * 100;
  //add color to show bar increasing or decreasing
  $(".playbackBar .progress").css("width", progress + "%");
}
//calculates percentage for progress bar
function updateVolumeProgressBar(audio){
  var volume = audio.volume * 100;
  //add color to show bar increasing or decreasing
  $(".volumeBar .progress").css("width", volume + "%");
}

function Audio(){
  this.currentlyPlaying;
  //this.audio = value; <same as> private variable = value;
  //'audio' is a built-in html audio element
  this.audio = document.createElement('audio');
  //when song ends, go to the next song
  this.audio.addEventListener("ended", function(){
    nextSong();
  });
  //when canplay (able to play a song) happens, run the function
  this.audio.addEventListener("canplay", function(){
    //call formatTime function to format the total time
    var duration = formatTime(this.duration);
    //jquery object to display time
    $(".progressTime.remaining").text(duration);
  });

  this.audio.addEventListener("timeupdate", function(){
    //if a duration exists
    if(this.duration){
      //send current audio file to updateTimeProgressBar function
      updateTimeProgressBar(this);
    }
  });

  this.audio.addEventListener("volumechange", function(){
    updateVolumeProgressBar(this);
  });

  this.setTrack = function(track){
    this.currentlyPlaying = track;
    //the source of the audio file (src) to be played is equal to the track being passed in
    this.audio.src = track.path; //path is the .mp3 file
  }
  this.play = function(){
    this.audio.play();
  }
  this.pause = function(){
    this.audio.pause();
  }
  this.setTime = function(seconds){
    this.audio.currentTime = seconds;
  }
}
