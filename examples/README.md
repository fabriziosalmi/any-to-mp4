## Examples

- [create video from website](https://github.com/fabriziosalmi/any-to-mp4/tree/master/examples/create_movie_from_website)
- [create video with TTS - gTTS](https://github.com/fabriziosalmi/any-to-mp4/tree/master/examples/create_video_with_TTS_GoogleTTS)
- [create video with TTS - txt2wav](https://github.com/fabriziosalmi/any-to-mp4/tree/master/examples/create_video_with_TTS_txt2wav)
- [create video with TTS - polly](https://github.com/fabriziosalmi/any-to-mp4/tree/master/examples/long_txt_to_video_with_TTS_polly)

#### Espeak TTS
`espeak -v it -s 141 -p 23 -f text.txt --stdout | ffmpeg -i - -ar 44100 -ac 2 -ab 192k -f mp3 reading.mp3`
