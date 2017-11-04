## Create video with TTS audio using gTTS

### create text file
`echo "Hello world" > /tmp/helloworld.txt`

### save an audio file using that text file as input
`gtts-cli -f /tmp/helloworld.txt -l 'en' -o /tmp/helloworld.mp3`

### create blank image
`convert -size 1280x720 xc:white /tmp/testimage.png`

### create video using that image as background and the mp3 file as audio content
`ffmpeg -loop 1 -i /tmp/testimage.png -i /tmp/helloworld.mp3 -shortest -c:v libx264 -c:a copy /tmp/video.mkv`

### convert mkv to mp4
`ffmpeg -i /tmp/video.mkv -vcodec copy -acodec copy /tmp/video.mp4`
