**Create a text file**

`echo "Hello world" > /tmp/helloworld.txt`

**Create an audio file using that text file as text input**

`gtts-cli -f /tmp/helloworld.txt -l 'en' -o /tmp/helloworld.mp3`
