<?php
// requirements: ffmpeg, sox, aws-tts, php, phantomjs
// example use: php-cgi -f any2mp4.php text="Some random string."

header('Content-type: text/html; charset=utf-8');

function mp3speed($mp3in, $mp3out, $speed) {
    $mp3speed = "/usr/bin/sox ".$mp3in. " ".$mp3out." tempo ".$speed;
    exec($mp3speed);
}

function generateRandomString($length = 32) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

echo "STEP 1: get item.."."\n";
// text input or anything else here
$txt = $_GET["text"];
$text_file = "/tmp/text_file.txt";
$tweak_file = "/tmp/tweak_file.txt";
$ssml_file = "/tmp/ssml_file.ssml";
file_put_contents($text_file, $txt);
echo "STEP 3: tweak text file.."."\n";
exec("tweak-txt.pl ".$text_file." > ".$tweak_file);
echo "STEP 4: convert txt to ssml.."."\n";
exec("txt2ssml.pl ".$tweak_file." > ".$ssml_file);
echo "STEP 5: convert ssml to mp3.."."\n";
$output_mp3 = "/tmp/output.mp3";
exec("ssml2mp3.py -o ".$output_mp3." --voice Giorgio ".$ssml_file); // --voice Carla (or others) to change sex and language
echo "STEP 6: speed up mp3 file.."."\n";
$final_mp3 = "/tmp/final.mp3";
mp3speed($output_mp3, $final_mp3, "1.07"); // 1.07x shorter
echo "STEP 7: create text snippets.."."\n";
$file = file_get_contents($tweak_file);
$width = 200; // change snap.php CSS style accordingly
$marker = "\n";
$wrapped = wordwrap($file, $width, $marker, true);
$lines = explode($marker, $wrapped);
$lines = array_filter($lines, function($value) { return $value !== ''; });
$snap_filename = "snap_";
$iii = 1;
foreach ($lines as $line_index=>$line){

$text_lenght = strlen($line);
echo "Text: ".$iii." (".$text_lenght.")\n";
	file_put_contents("/tmp/snaps/".$snap_filename.$iii.".txt", $line);
	$iii++;

}

echo "STEP 8: create png snippets.."."\n";
$snaps_count=exec("ls -la /tmp/snaps/snap*.txt | wc -l");

for ($i=1; $i<=$snaps_count; $i++) {

 $gen_snaps="phantomjs screenshot.js https://website.domain.ext/snap.php?snap=".$i." /tmp/snaps/snap_".$i.".png"; // change website.domain.ext to a working webserver
 exec($gen_snaps);
 echo "Slide: ".$i."\n";
}

echo "STEP 9: calculate frame duration.."."\n";
$audio_duration = exec("soxi -D ".$final_mp3);
$audio_duration = round($audio_duration);
$snaps_count = exec("ls -la /tmp/snaps/*.png | wc -l");
$frame_lenght = $audio_duration/$snaps_count;
$frame_lenght = round($frame_lenght, 2);
echo "Audio duration: ".$audio_duration."\n";
echo "Frames count: ".$snaps_count."\n";
echo "Frame duration: ".$frame_lenght."\n";
echo "STEP 10: create video file.."."\n";
$randomString = generateRandomString();
$output_video = "/tmp/".$randomString.".mp4";
$gen_video="ffmpeg -hide_banner -loglevel panic -framerate 1/".$frame_lenght." -i /tmp/snaps/snap_%d.png -i ".$final_mp3." -c:v libx264 -c:a copy -shortest -r 30 -pix_fmt yuv420p ".$output_video;
exec($gen_video);
echo "STEP 11: clean up files.."."\n";
exec("cp ".$output_video." .");
exec("rm -rf /tmp/snaps/* /tmp/text_file.txt /tmp/tweak_file.txt /tmp/ssml_file.ssml /tmp/final.mp3 /tmp/output.mp3 ".$output_video);
echo "VIDEO: https://website.domain.ext/".str_replace("/tmp/", "", $output_video)."\n";

?>
