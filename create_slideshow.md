## Create slideshow from images

### Requirements

- ffmpeg
- php

### Example

In this example script all images should be in the `slides` folder and named as `slide_%d.png` (slide_1.png, slide_2.png...)

```
<?php
  exec('ffmpeg -y -loglevel panic -hide_banner -framerate 1/7 -i slides/slide_%d.jpg -vf scale=1280:720 -c:v libx264 -pix_fmt yuv420p -r 30 /YOUR_PHP_PATH/tmp/slideshow.mp4');
  $random_query_string = md5(rand(1,9999999)."fudyfew"); // Weak! Use a random string generator instead!!
  echo '<a href="https://YOUR_PHP_WEBSITE/tmp/slideshow.mp4?rel='.$random_query_string.'" target="_blank">https://YOUR_PHP_WEBSITE/tmp/slideshow.mp4</a>';
?>
```
