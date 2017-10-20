## Configure the AWS credentials 

File: `~/.aws/credentials`

```
[default]
aws_access_key_id = XXXXXXXXXXXXXXX
aws_secret_access_key = XXXXXXXXXXXXXXXXXXXXXXXXXX
```

**Note:** AWS region must be in US

## Download, setup and install

`pip install boto3`

`git clone https://github.com/agentzh/amazon-polly-batch`

`unzip master.zip && cd amazon-polly-batch`

## Conversion process

**Clean txt file**

`./tweak-txt.pl file.txt > file-new.txt`

**Create ssml file**

`./txt2ssml.pl -s slow file-new.txt > file-new.ssml`

**Voice speed (optional)**

Possible speech rates are `x-slow`, `medium`, `fast`, and `x-fast`

**Create mp3 from txt**

`./ssml2mp3.py -o file.mp3 --voice Salli file-new.ssml`

**Note:** Italian voices are `Giorgio` and `Carla`

**Optional: speed up with sox (PHP)**

```
function mp3speed($mp3in, $mp3out, $speed) {
    $mp3speed = "/usr/bin/sox ".$mp3in. " ".$mp3out." tempo ".$speed;
    exec($mp3speed);
}

mp3speed("file.mp3", "file_speed_117.mp3", "1.17");
```
**Note:** `1.17` is a reasonable value for Amazon Polly (Giorgio voice, -57% file size)

## PHP script

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

// TODO cleaner

?>
```
