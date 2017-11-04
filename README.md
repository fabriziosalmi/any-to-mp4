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

### Espeak TTS
`espeak -v it -s 141 -p 23 -f text.txt --stdout | ffmpeg -i - -ar 44100 -ac 2 -ab 192k -f mp3 reading.mp3`

### [TXT to TTS with Amazon Polly](https://github.com/fabriziosalmi/any-to-mp4/blob/master/txt2mp3_tts_amazon.md)
