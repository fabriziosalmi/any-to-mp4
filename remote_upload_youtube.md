## Remote YouTube uploader example

```
<?php
// no escapes.. fix before use.. otherwise who knows?

$title = $_GET["title"];
$description = $_GET["description"];
$playlist = $_GET["playlist"];
$privacy = $_GET["privacy"];
$category = $_GET["category"];
$default_language = $_GET["default_language"];
$default_audio_language = $_GET["default_audio_language"];

$video_url = $_GET["video_url"];
$videofile = "tmp/localvideo.mp4";
$video = file_put_contents($videofile, file_get_contents($video_url));

$thumb_url = $_GET["thumb_url"];
$thumbfile = "tmp/localthumb.png";
$thumb = file_put_contents($thumbfile, file_get_contents($thumb_url));

// should be dynamic
$youtube-upload = "/PATH/youtube-upload-master/bin/youtube-upload";
$youtube = '/usr/bin/python2.7 '.$youtube-upload.' --title="'.$title.'" --description="'.$description.'" --category="'.$category.'" --privacy=".$privacy." --thumbnail '.$thumbfile.' --tags="'.$tags.'" --default-language="'.$default_language.'" --default-audio-language="'.$default_audio_language.'" --playlist "'.$playlist.'" --auth-browser '.$videofile;
shell_exec($youtube);
exec('rm -rf tmp/localvideo.mp4');
exec('rm -rf tmp/localthumb.png');
?>
```
