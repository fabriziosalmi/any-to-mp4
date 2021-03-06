### Wikipedia to MP3 converter (Amazon Polly TTS)

**Example use**

`php-cgi -f wikitts.php query=Wikipedia pars=1 mode=mp3`

*Output*

```
array(4) {
  ["title"]=>
  string(9) "Wikipedia"
  ["content"]=>
  string(210) "Wikipedia è un'enciclopedia online a contenuto libero, collaborativa, multilingue e gratuita, nata nel 2001, sostenuta e ospitata dalla Wikimedia Foundation, un'organizzazione non a scopo di lucro statunitense."
  ["mp3"]=>
  string(45) "tmp/wiki_0c341ac27ec3562ece384ddaa915b211.mp3"
  ["json"]=>
  string(46) "tmp/wiki_0c341ac27ec3562ece384ddaa915b211.json"
}
```

**Next features**

- input formats (txt, json)
- security (network, input)
- lexicon for better readings
- multiple outputs (mp4, html, images)

**wikitts.php**

```
<?php

// WIKITTS

$vmode = $_GET["mode"];

if ($vmode != "mp3") {
  echo "ERROR: vmode ".$vmode." is not valid. \n";
  die();
}

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
$content = preg_replace( '/\s+/', ' ', $content);
$content = preg_replace('/\([^\)]+\)/', '', $content);
$a = explode(". ", $content);
$a = array_slice($a, 0, $paragraphs);
$content = implode('. ', $a);
$content = str_replace("  ", " ", $content);
// any word after last "." is removed
$content_arr = explode(". ", $content);
array_pop($content_arr);
$content = implode(". ", $content_arr).".";

// hash and filenames
$hash = md5(rand(0,99999999)."fhoweufwe");
$wiki_txt = "tmp/wiki_".$hash.".txt";
$wiki_mp3 = "tmp/wiki_".$hash.".mp3";
$wiki_json = "tmp/wiki_".$hash.".json";
file_put_contents($wiki_txt, $content);

// build JSON
$media = array();
$media["title"] = $query;
$media["content"] = $content;
$media["mp3"] = $wiki_mp3;
$media["json"] = $wiki_json;
file_put_contents($wiki_json, json_encode($media));

// text to mp3 (Amazon Polly)
exec("/usr/bin/perl tweak-txt.pl ".$wiki_txt." > tmp/wiki2.txt");
exec("/usr/bin/perl txt2ssml.pl -s fast tmp/wiki2.txt > tmp/wiki.ssml");
exec("/usr/bin/python ssml2mp3.py tmp/wiki.ssml -o ".$wiki_mp3);
// TTS options: gtts-cli, txt2wav, espeak

// speed up mp3
$temp_mp3 = "tmp/mp3_speed.mp3";
exec("cp ".$wiki_mp3." ".$temp_mp3);
$mp3speed = "/usr/bin/sox ".$temp_mp3. " ".$wiki_mp3." tempo 1.15";
exec($mp3speed);

// output data
var_dump($media);

// funny stuff
unset($content_arr);
unset($media);
unset($content);
unset($query);

?>
```
