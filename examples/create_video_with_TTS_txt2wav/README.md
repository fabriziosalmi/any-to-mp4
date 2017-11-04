## Create HD video with TTS voice

TTS voice used: **txt2wave.py**

### Setup

```
apt-get update
apt-get install -y imagemagick ffmpeg php-cli python-dev build-essential python-pip poppler-utils unzip
apt-get install -y libttspico0 libttspico-utils libttspico-data espeak
apt-get install -y chrpath libssl-dev libxft-dev libfreetype6 libfreetype6-dev libfontconfig1 libfontconfig1-dev
pip install --upgrade pip
pip install pyttsx
wget https://github.com/Harumaro/pico-read-speaker/blob/improvement/output-folder-param/txt2wave.py
ln -s txt2wave.py /usr/bin/txt2wave.py
```

### Run

`./create_video.sh`
