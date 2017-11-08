## Convert a text input to video with reading TTS

### Process

- get text file as input
- convert txt file to audio with TTS reading the text file content
- convert as many chunks of text required to make 1280x720 html page with chunked text content
- make a screenshot of each generated web page
- make a video with TTS reading synced with the screenshots slideshow

### Requirements

- php-cli, php-fpm
- nginx
- python
- [ffmpeg](https://www.ffmpeg.org/)
- [Sox](http://sox.sourceforge.net/) with [mp3 support](https://superuser.com/questions/421153/how-to-add-a-mp3-handler-to-sox/421168)
- [amazon-polly-batch](https://github.com/agentzh/amazon-polly-batch)

### Files

- any2mp4.php
- background.png
- screenshot.js
- snap.php
- text_input.txt
