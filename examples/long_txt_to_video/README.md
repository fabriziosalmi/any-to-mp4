## Convert a long text file to video

### Process

- get text file as input
- convert txt file to audio with TTS reading the text file content
- convert as many chunks of text required to make 1280x720 html page with chunked text content
- make a screenshot of each generated web page
- make a video with TTS reading as audio synced with the slideshow of screenshots

### Requirements

- ffmpeg
- sox
- aws-tts
- php-cli, php-fpm
- nginx
- python

### Files

- any2mp4.php
- background.png
- screenshot.js
- snap.php
