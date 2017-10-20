## Speed up mp3 file

```
function mp3speed($mp3in, $mp3out, $speed) {
    $mp3speed = "/usr/bin/sox ".$mp3in. " ".$mp3out." tempo ".$speed;
    exec($mp3speed);
}
```

## Convert MP3 to MKV video

```
function mp32mkv($mp3, $mkv, $image) {
    $mp32mkv = "/usr/bin/ffmpeg -loop 1 -i ".$image." -i ".$mp3." -shortest -c:v libx264 -c:a copy ".$mkv;
    exec($mp32mkv);
}
```

## Convert MKV video to MP4 video

```
function mkv2mp4($mkv, $mp4) {
    $mkv2mp4 = "/usr/bin/ffmpeg -i ".$mkv." -vcodec copy -acodec copy ".$mp4;
    exec($mkv2mp4);
}
```
