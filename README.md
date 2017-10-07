# Convert any file to mp4 video

This can be a good start for your video marketing strategy.

**Requirements**

- [Debian 8](https://www.debian.org) or any other Linux flavour
- [ffmpeg](https://www.ffmpeg.org/)
- [php cli](http://php.net/manual/en/features.commandline.php)
- [Python Pip](https://pypi.python.org/pypi/pip)
- [gTTS](https://github.com/pndurette/gTTS)
- [pdftotext](https://linux.die.net/man/1/pdftotext)
- [Sox](http://sox.sourceforge.net/) with [mp3 support](https://superuser.com/questions/421153/how-to-add-a-mp3-handler-to-sox/421168)
- [ImageMagick](https://www.imagemagick.org/script/index.php)

**Environment setup**

```
apt-get update
apt-get install -y ffmpeg php-cli python-dev build-essential python-pip poppler-utils sox libsox-fmt-mp3
apt-get install chrpath libssl-dev libxft-dev libfreetype6 libfreetype6-dev libfontconfig1 libfontconfig1-dev
pip install --upgrade pip
pip install gTTS
apt-get install -y npm
```

- [PhantomJS setup](https://gist.github.com/julionc/7476620)

**Example**

```
# create text file
echo "Hello world" > /tmp/helloworld.txt

# save an audio file using that text file as input
gtts-cli -f /tmp/helloworld.txt -l 'en' -o /tmp/helloworld.mp3

# create blank image
convert -size 1280x720 xc:white /tmp/testimage.png

# create video using blank image as background and the mp3 file as audio content
ffmpeg -loop 1 -i /tmp/testimage.png -i /tmp/helloworld.mp3 -shortest -c:v libx264 -c:a copy /tmp/video.mkv

# convert mkv to mp4
ffmpeg -i /tmp/video.mkv -vcodec copy -acodec copy /tmp/video.mp4
```

**Espeak TTS**

`espeak -v it -s 141 -p 23 -f testo.txt --stdout | ffmpeg -i - -ar 44100 -ac 2 -ab 192k -f mp3 testo7.mp3`

**Grab website to frames and make video**

`xvfb-run phantomjs test.js && ffmpeg -start_number 10 -i frames/frame_%02d.png -c:v libx264 -r 25 -pix_fmt yuv420p out5.mp4`

```
var page = require('webpage').create();
page.viewportSize = { width: 640, height: 480 };

page.open('https://website.domain/page.html', function () {
  setTimeout(function() {
    // Initial frame
    var frame = 0;
    // Add an interval every 25th second
    setInterval(function() {
      // Render an image with the frame name
      page.render('frames/frame_'+(frame++)+'.png', { format: "png" });
      // Exit after 50 images
      if(frame > 50) {
        phantom.exit();
      }
    }, 25);
  }, 666);
});
```
