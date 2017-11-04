## Create movie from website with PhantomJS, xvfb and ffmpeg

### Requirements

- xvfb
- phantomjs
- ffmpeg

### Create movie from website screenshots

`xvfb-run phantomjs test.js && ffmpeg -start_number 10 -i frames/frame_%02d.png -c:v libx264 -r 25 -pix_fmt yuv420p out5.mp4`
