<?php
// get content from Wikipedia title: Wikipedia
// paragraphs to use: 10
// command: /usb/bin/php-cgi -f wikipedia.php query=Wikipedia pars=10

$paragraphs = $_GET["pars"];
$query = $_GET["query"];
$query = str_replace(" ", "_", $query);
// more filters

// wikipedia text
$url = "https://it.wikipedia.org/w/api.php?format=json&action=query&redirect=1&prop=extracts&explaintext=1&titles=".$query;
$response = json_decode(file_get_contents($url, true));
$page = $response->query->pages;
$api_text = ((object)reset($page)->extract);
$content = $api_text->scalar;

// content filter
$content_filter = array("\n\n\n", "\n\n");
$content = str_replace($content_filter, "\n", $content);
$content_filter = array(" =="," ==="," ==="," ==="," =====");
$content = str_replace($content_filter, ". ", $content);
$content_filter = array("====","===","=="," =\n");
$content = str_replace($content_filter, " ", $content);
$content = preg_replace( '/\s+/', ' ', $content );


$a = explode(". ", $content);
$a = array_slice($a, 0, $paragraphs);
$content = implode('. ', $a);

// wikipedia image API
$wiki_image_api = "https://it.wikipedia.org/w/api.php?action=query&redirect=1&titles=".$query."&prop=pageimages&format=json&pithumbsize=640";
$wiki_image = json_decode(file_get_contents($wiki_image_api, true));
$image = $wiki_image->query->pages;
$image_url = ((object)reset($image)->thumbnail);
$image_content = $image_url->source;
$image_content_data = file_get_contents($image_content);

// hash and filenames
$hash = md5(rand(0,99999999)."fhoweufwe");
$wiki_txt = "tmp/wiki_".$hash.".txt";
$wiki_img = "tmp/wiki_".$hash.".png";
$wiki_mp3 = "tmp/wiki_".$hash.".mp3";
$wiki_mp4 = "tmp/wiki_".$hash.".mp4";
$wiki_json = "tmp/wiki_".$hash.".json";

file_put_contents($wiki_txt, $content);
file_put_contents($wiki_img, $image_content_data);

$media = array();
$media["title"] = $query;
$media["content"] = $content;
$media["image"] = $wiki_img;
$media["mp3"] = $wiki_mp3;
$media["mp4"] = $wiki_mp4;
$media["json"] = $wiki_json;

file_put_contents($wiki_json, $media);

// text to mp3 (Amazon Polly)
exec("/usr/bin/perl tweak-txt.pl ".$wiki_txt." > tmp/wiki2.txt");
exec("/usr/bin/perl txt2ssml.pl tmp/wiki2.txt > tmp/wiki.ssml");
exec("/usr/bin/python ssml2mp3.py tmp/wiki.ssml -o ".$wiki_mp3);
// alternatives: gtts-cli, txt2wav

$ffmpeg = '/usr/bin/ffmpeg -hide_banner -loglevel error -i '.$wiki_mp3.' -filter_complex "[0:a]showwaves=s=1280x720:mode=line:rate=25,format=yuv420p[v]" -map "[v]" -map 0:a '.$wiki_mp4;
exec($ffmpeg);

var_dump($media);

?>
