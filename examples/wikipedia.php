<?php

// query = get url;
$query = "Test";
$query = str_replace(" ", "_", $query);

// unique
$hash = md5(rand(0,99999999)."fhoweufwe");

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

// paragraphs
$paragraphs = "60";
$a = explode(". ", $content);
$a = array_slice($a, 0, $paragraphs);
$content = implode('. ', $a);

// wikipedia image
$wiki_image_api = "https://it.wikipedia.org/w/api.php?action=query&redirect=1&titles=".$query."&prop=pageimages&format=json&pithumbsize=640";
$wiki_image = json_decode(file_get_contents($wiki_image_api, true));
$image = $wiki_image->query->pages;
$image_url = ((object)reset($image)->thumbnail);
$image_content = $image_url->source;
$image_content_data = file_get_contents($image_content);

// save to disk
$wiki_txt = "tmp/wiki_".$hash.".txt";
$wiki_img = "tmp/wiki_".$hash.".png";
$wiki_mp3 = "tmp/wiki_".$hash.".mp3";

file_put_contents($wiki_txt, $content);
file_put_contents($wiki_img, $image_content_data);

// text to mp3 (Amazon Polly)
exec("/usr/bin/perl tweak-txt.pl ".$wiki_txt." > tmp/wiki2.txt");
exec("/usr/bin/perl txt2ssml.pl tmp/wiki2.txt > tmp/wiki.ssml");
exec("/usr/bin/python ssml2mp3.py tmp/wiki.ssml -o ".$wiki_mp3);
// others: gtts-cli, txt2wave.py


$media = array();

$media["title"] = $query;
$media["content"] = $content;
$media["image"] = $wiki_img;
$media["mp3"] = $wiki_mp3;

var_dump($media);

// ffmpeg -i tmp/wiki_3614fd73eea959959d5c6e0f701aef21.mp3 -filter_complex "[0:a]showwaves=s=1280x720:mode=line:rate=25,format=yuv420p[v]" -map "[v]" -map 0:a tmp/outputTEST.mp4
// resize image to 1280x720 watermark
// ffmpeg -i test.mp4 -i watermark.png -filter_complex "overlay=x=(main_w-overlay_w)/2:y=(main_h-overlay_h)/2" test2.mp4
// ffmpeg merge with green screen animated logos
?>
