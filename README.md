# How to convert text content to MP3 audio and MP4 video files

Any2Mp4 is a mix of open source snippets to quickly test automated video generation.

## [Examples](https://github.com/fabriziosalmi/any-to-mp4/tree/master/examples)

- [txt2mp3](https://github.com/fabriziosalmi/any-to-mp4/tree/master/examples/txt2mp3)
- [create video from Wikipedia](https://github.com/fabriziosalmi/any-to-mp4/tree/master/examples/create_video_from_Wikipedia)
- [create video from a website](https://github.com/fabriziosalmi/any-to-mp4/tree/master/examples/create_movie_from_website)
- [create video with TTS - gTTS](https://github.com/fabriziosalmi/any-to-mp4/tree/master/examples/create_video_with_TTS_GoogleTTS)
- [create video with TTS - txt2wav](https://github.com/fabriziosalmi/any-to-mp4/tree/master/examples/create_video_with_TTS_txt2wav)
- [create video with TTS - polly](https://github.com/fabriziosalmi/any-to-mp4/tree/master/examples/long_txt_to_video_with_TTS_polly)
- [some PHP snippets](https://github.com/fabriziosalmi/any-to-mp4/blob/master/snippets.md)

## Technologies

- [Debian 8](https://www.debian.org) or any other Linux flavour, [ffmpeg](https://www.ffmpeg.org/), [php cli](http://php.net/manual/en/features.commandline.php), [Python Pip](https://pypi.python.org/pypi/pip), [gTTS](https://github.com/pndurette/gTTS), [pdftotext](https://linux.die.net/man/1/pdftotext), [txt2wave](https://github.com/Harumaro/pico-read-speaker/blob/improvement/output-folder-param/txt2wave.py), [Sox](http://sox.sourceforge.net/) with [mp3 support](https://superuser.com/questions/421153/how-to-add-a-mp3-handler-to-sox/421168), [ImageMagick](https://www.imagemagick.org/script/index.php), [AWS cli](https://aws.amazon.com/it/blogs/aws/polly-text-to-speech-in-47-voices-and-24-languages/), [Amazon-Polly-Batch](https://github.com/agentzh/amazon-polly-batch), Perl is required, a web server is required to get website screenshots using [PhantomJS](http://phantomjs.org/).

## Setup

```
apt-get update
apt-get install -y ffmpeg php-cli python-dev build-essential python-pip poppler-utils sox libsox-fmt-mp3 unzip libttspico0 libttspico-utils libttspico-data espeak chrpath libssl-dev libxft-dev libfreetype6 libfreetype6-dev libfontconfig1 libfontconfig1-dev npm xvfb
pip install gTTS pyttsx awscli boto3
npm install phantomjs
wget https://github.com/Harumaro/pico-read-speaker/blob/improvement/output-folder-param/txt2wave.py
git clone https://github.com/agentzh/amazon-polly-batch/archive/master.zip
```
