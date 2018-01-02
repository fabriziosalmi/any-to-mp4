### Create audio file with eSpeak TTS voice

**shell script**

```
echo "Buongiorno a tutti" > content.txt
espeak -v it -s 141 -p 23 -f content.txt --stdout | ffmpeg -i - -ar 44100 -ac 2 -ab 192k -f mp3 buongiorno.mp3
```
