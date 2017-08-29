# Convert any file to mp4 video

This can be a good start for your video marketing strategy.

**Requirements**

- Debian 8 or any other Linux flavour
- [ffmpeg](https://github.com/fabriziosalmi/MP32MP4)
- [php cli](http://php.net/manual/en/features.commandline.php)
- [Python Pip](https://syscoding.com/tutorials/32/how-to-install-and-use-python-pip-on-debian-8/)
- [gTTS](https://github.com/pndurette/gTTS)
- [pdftotext](https://www.cyberciti.biz/faq/converter-pdf-files-to-text-format-command/)
- [Sox](http://sox.sourceforge.net/)
- [Sox mp3 support](https://superuser.com/questions/421153/how-to-add-a-mp3-handler-to-sox/421168)

**Environment setup**

```
apt-get update
apt-get install ffmpeg php-cli python-dev build-essential
apt-get install python-pip
pip install --upgrade pip
pip install gTTS
apt-get install poppler-utils
apt-get install sox libsox-fmt-mp3
```

