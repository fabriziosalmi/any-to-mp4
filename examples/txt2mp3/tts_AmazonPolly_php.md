**PHP**

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
