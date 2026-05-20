
<html>
	<head>
	</head>
	<body>
<!doctype html>
<html>
   <head>
      <title>Multi-Source Audio Player</title>
	    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
   </head>
   <body>
    <audio id="soundHandle" style="display:none;"></audio>

<script type="text/javascript">

var soundHandle = document.getElementById('soundHandle');

$(document).ready(function() {
    addEventListener('touchstart', function (e) {
        soundHandle.src = 'audio.mp3';
        soundHandle.loop = true;
        soundHandle.play();
        soundHandle.pause();
    });
});

</script>
  </body>
</html>
	
<!--<audio id="audio" src="good-msg-tone-50191.mp3" controls="controls" loop="loop">
</audio>
<script type="text/javascript"> 
    window.onload = function() {
        var audioPlayer = document.getElementById("audio");
        audioPlayer.load();
        audioPlayer.play();
    };
    </script>-->