## Examples

- [create video from website](https://github.com/fabriziosalmi/any-to-mp4/tree/master/examples/create_movie_from_website)
- [create video with TTS - gTTS](https://github.com/fabriziosalmi/any-to-mp4/tree/master/examples/create_video_with_TTS_GoogleTTS)
- [create video with TTS - txt2wav](https://github.com/fabriziosalmi/any-to-mp4/tree/master/examples/create_video_with_TTS_txt2wav)
- [create video with TTS - polly](https://github.com/fabriziosalmi/any-to-mp4/tree/master/examples/long_txt_to_video_with_TTS_polly)

## Other examples

### Text to TTS (Amazon Polly)

#### Configure the AWS credentials 

File: `~/.aws/credentials`

```
[default]
aws_access_key_id = XXXXXXXXXXXXXXX
aws_secret_access_key = XXXXXXXXXXXXXXXXXXXXXXXXXX
```

**Note:** AWS region must be in US

#### Download, setup and install

`pip install boto3` + `git clone https://github.com/agentzh/amazon-polly-batch`

#### Conversion process

- Clean txt file and create ssml file

`./tweak-txt.pl file.txt > file-new.txt` `./txt2ssml.pl -s medium file-new.txt > file-new.ssml`

Possible speech rates are `x-slow`, `medium`, `fast`, and `x-fast`

- Create mp3 from txt

`./ssml2mp3.py -o file.mp3 --voice Salli file-new.ssml`

Italian voices are `Giorgio` and `Carla`.

- Optional: speed up audio with sox

```
function mp3speed($mp3in, $mp3out, $speed) {
    $mp3speed = "/usr/bin/sox ".$mp3in. " ".$mp3out." tempo ".$speed;
    exec($mp3speed);
}

mp3speed("file.mp3", "file_speed_117.mp3", "1.17");
```

**PHP script**

```
<?php

function txt2polly($original_txt, $cleaned_txt, $ssml, $output_mp3, $voice) {

  $cleantxt = "tweak-txt.pl ".$original_txt." > ".$cleaned_txt;
  exec($cleantxt);
  $create_ssml = "txt2ssml.pl -s fast ".$cleaned_txt." > ".$ssml;
  exec($cleantxt);
  $create_mp3 = "ssml2mp3.py -o ". $output_mp3." --voice ".$voice." ".$ssml;
  exec($create_mp3);

}

$original_txt = "/path/to/input.txt";
$cleaned_txt = "/path/to/output.txt";
$ssml = "/path/to/output.ssml";
$output_mp3 = "/path/to/output.mp3";
$voice = "Giorgio"; // Italian male, for female use Carla

// Example use
txt2polly($original_txt, $cleaned_txt, $ssml, $output_mp3, $voice);

?>
```

### Text to TTS (Espeak)
`espeak -v it -s 141 -p 23 -f text.txt --stdout | ffmpeg -i - -ar 44100 -ac 2 -ab 192k -f mp3 reading.mp3`
