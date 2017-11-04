## Examples

- [create video from website](https://github.com/fabriziosalmi/any-to-mp4/tree/master/examples/create_movie_from_website)
- [create video with TTS - gTTS](https://github.com/fabriziosalmi/any-to-mp4/tree/master/examples/create_video_with_TTS_GoogleTTS)
- [create video with TTS - txt2wav](https://github.com/fabriziosalmi/any-to-mp4/tree/master/examples/create_video_with_TTS_txt2wav)
- [create video with TTS - polly](https://github.com/fabriziosalmi/any-to-mp4/tree/master/examples/long_txt_to_video_with_TTS_polly)

### Other examples

#### Create slideshow (ffmpeg + PHP)

```
<?php
  exec('ffmpeg -y -loglevel panic -hide_banner -framerate 1/7 -i /tmp/slides/slide_%d.jpg -vf scale=1280:720 -c:v libx264 -pix_fmt yuv420p -r 30 /YOUR_PHP_PATH/tmp/slideshow.mp4');
  $random_query_string = md5(rand(1,9999999)."fudyfew"); // Weak! Use a random string generator instead!!
  echo '<a href="https://YOUR_PHP_WEBSITE/tmp/slideshow.mp4?rel='.$random_query_string.'" target="_blank">https://YOUR_PHP_WEBSITE/tmp/slideshow.mp4</a>';
?>
```

#### Espeak TTS
`espeak -v it -s 141 -p 23 -f text.txt --stdout | ffmpeg -i - -ar 44100 -ac 2 -ab 192k -f mp3 reading.mp3`
