<?php

$image = "/mnt/test/img/test_background.png";
$mp3_input = "/mnt/test/tts/out/01a03b935dfd9c94c98df7cbddf581b2.mp3";
$mkvout = "/mnt/test/mp4/01a03b935dfd9c94c98df7cbddf581b2.mkv";
$mp4out = "/mnt/test/mp4/01a03b935dfd9c94c98df7cbddf581b2.mp4";

$mp32mp4 = "ffmpeg -loop 1 -i ".$image." -i ".$mp3_input." -shortest -c:v libx264 -c:a copy ".$mkvout;
exec($mp32mp4);
$mkv2mp4 = "ffmpeg -i ".$mkvout." -vcodec copy -acodec copy ".$mp4out;
exec($mkv2mp4);

?>