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
