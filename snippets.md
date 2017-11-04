## PHP snippets

### Convert TXT to MP3 (txt2wav)

```
$random_string = generateRandomString();

function txt2mp3($txt) {
  $filename = "_tmp_".$random_string.".txt";
  file_put_contents($filename, file_get_contents($txt));
  $cmd = "/usr/bin/python /var/www/html/txt2wav.py -i ".$filename." -l it-IT -o /var/www/html/storage/mp3";
  exec($cmd);
  $output_mp3 = "/var/www/html/storage/mp3/".str_replace(".txt", ".mp3", $filename);
  return $output_mp3;
}


```

### Speed up mp3 file

```
function mp3speed($mp3in, $mp3out, $speed) {
    $mp3speed = "/usr/bin/sox ".$mp3in. " ".$mp3out." tempo ".$speed;
    exec($mp3speed);
}
```

### Convert MP3 to MKV video

```
function mp32mkv($mp3, $mkv, $image) {
    $mp32mkv = "/usr/bin/ffmpeg -loop 1 -i ".$image." -i ".$mp3." -shortest -c:v libx264 -c:a copy ".$mkv;
    exec($mp32mkv);
}
```

### Convert MKV video to MP4 video

```
function mkv2mp4($mkv, $mp4) {
    $mkv2mp4 = "/usr/bin/ffmpeg -i ".$mkv." -vcodec copy -acodec copy ".$mp4;
    exec($mkv2mp4);
}
```

### Generate random string (32 chars)

```
// Source: https://stackoverflow.com/questions/4356289/php-random-string-generator

function generateRandomString($length = 32) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
```
