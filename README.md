# Convert any file to video

Any2Mp4 is a mix of open source snippets to quickly test automated video generation.

## Requirements

- [Debian 8](https://www.debian.org) or any other Linux flavour
- [ffmpeg](https://www.ffmpeg.org/)
- [php cli](http://php.net/manual/en/features.commandline.php)
- [Python Pip](https://pypi.python.org/pypi/pip)
- [gTTS](https://github.com/pndurette/gTTS)
- [pdftotext](https://linux.die.net/man/1/pdftotext)
- [Sox](http://sox.sourceforge.net/) with [mp3 support](https://superuser.com/questions/421153/how-to-add-a-mp3-handler-to-sox/421168)
- [ImageMagick](https://www.imagemagick.org/script/index.php)
- [AWS cli](https://aws.amazon.com/it/blogs/aws/polly-text-to-speech-in-47-voices-and-24-languages/)
- [Amazon-Polly-Batch](https://github.com/agentzh/amazon-polly-batch)
- Perl is required

## Setup

```
apt-get update
apt-get install -y ffmpeg php-cli python-dev build-essential python-pip poppler-utils sox libsox-fmt-mp3 unzip
apt-get install -y libttspico0 libttspico-utils libttspico-data espeak
apt-get install -y chrpath libssl-dev libxft-dev libfreetype6 libfreetype6-dev libfontconfig1 libfontconfig1-dev
pip install --upgrade pip
pip install gTTS
pip install pyttsx
pip install awscli
pip install boto3
wget https://github.com/Harumaro/pico-read-speaker/blob/improvement/output-folder-param/txt2wave.py
apt-get install -y npm xvfb
npm install phantomjs
git clone https://github.com/agentzh/amazon-polly-batch/archive/master.zip && unzip master.zip && cd amazon-polly-batch
```

## Examples

- [awscli](https://gist.github.com/anamorph/aaf8434d3bbad92059b3)

- create text file
`echo "Hello world" > /tmp/helloworld.txt`

- save an audio file using that text file as input
`gtts-cli -f /tmp/helloworld.txt -l 'en' -o /tmp/helloworld.mp3`

- create blank image
`convert -size 1280x720 xc:white /tmp/testimage.png`

- create video using that image as background and the mp3 file as audio content
`ffmpeg -loop 1 -i /tmp/testimage.png -i /tmp/helloworld.mp3 -shortest -c:v libx264 -c:a copy /tmp/video.mkv`

- convert mkv to mp4
`ffmpeg -i /tmp/video.mkv -vcodec copy -acodec copy /tmp/video.mp4`

- Espeak TTS
`espeak -v it -s 141 -p 23 -f testo.txt --stdout | ffmpeg -i - -ar 44100 -ac 2 -ab 192k -f mp3 testo7.mp3`

- [convert txt to Amazon Polly MP3 TTS](https://github.com/fabriziosalmi/any-to-mp4/blob/master/txt2mp3_tts_amazon.md)


## Screenshots as frames

`xvfb-run phantomjs test.js && ffmpeg -start_number 10 -i frames/frame_%02d.png -c:v libx264 -r 25 -pix_fmt yuv420p out5.mp4`

- file test.js

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
  }, 777);
});
```

## Remote YouTube uploader example

```
<?php
// no escapes.. fix before use.. otherwise who knows?

$title = $_GET["title"];
$description = $_GET["description"];
$playlist = $_GET["playlist"];
$privacy = $_GET["privacy"];
$category = $_GET["category"];
$default_language = $_GET["default_language"];
$default_audio_language = $_GET["default_audio_language"];

$video_url = $_GET["video_url"];
$videofile = "tmp/localvideo.mp4";
$video = file_put_contents($videofile, file_get_contents($video_url));

$thumb_url = $_GET["thumb_url"];
$thumbfile = "tmp/localthumb.png";
$thumb = file_put_contents($thumbfile, file_get_contents($thumb_url));

// dhould be dynamic
$youtube-upload = "/PATH/youtube-upload-master/bin/youtube-upload";

$youtube = '/usr/bin/python2.7 '.$youtube-upload.' --title="'.$title.'" --description="'.$description.'" --category="'.$category.'" --privacy=".$privacy." --thumbnail '.$thumbfile.' --tags="'.$tags.'" --default-language="'.$default_language.'" --default-audio-language="'.$default_audio_language.'" --playlist "'.$playlist.'" --auth-browser '.$videofile;
shell_exec($youtube);
exec('rm -rf tmp/localvideo.mp4');
exec('rm -rf tmp/localthumb.png');
```
