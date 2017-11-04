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
### Bash script

```
#!/bin/bash

# replace with your better random string if desired
randomtext=`date | md5sum | cut -c 1-32`

echo Titolo
read title
echo Contenuto
read content
echo $content > /var/www/PATH/storage/content.txt

/usr/bin/convert -size 1280x720 -background white -gravity center label:$title /var/www/PATH/storage/background.jpg
/usr/bin/python2.7 /var/www/PATH/txt2wave.py -i /var/www/PATH/storage/content.txt -l it-IT
/usr/bin/ffmpeg -loop 1 -i /var/www/PATH/storage/background.jpg -i /var/www/PATH/storage/content.mp3 -shortest -c:v libx264 -c:a copy /var/www/PATH/storage/video.mkv
/usr/bin/ffmpeg -i /var/www/PATH/storage/video.mkv -vcodec copy -acodec copy /var/www/PATH/storage/$randomtext.mp4
/bin/rm -rf /var/www/PATH/storage/background.jpg /var/www/PATH/storage/content.txt
/bin/rm -rf /var/www/PATH/storage/content.mp3 /var/www/PATH/storage/video.mkv

echo "\nVIDEO: "$title "\n"
echo "https://PATH/storage/"$randomtext".mp4"
```
