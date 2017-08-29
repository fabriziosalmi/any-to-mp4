<?php

$base_path = "/mnt/test/tts";
$path_txt_in = $base_path."/in";
$path_mp3_out = $base_path."/out";

$latest_txt = 'ls -tr '.$path_txt_in.' | head -n2 | tail -n1 | grep ".txt"';
$latest_txt_res = exec($latest_txt);
$mp3_filename = str_replace(".txt", ".mp3", $latest_txt_res);
$full_txt_path = $path_txt_in."/".$latest_txt_res;
$full_mp3_path = $path_mp3_out."/slow_".$mp3_filename;

$txt2mp3 = "/usr/local/bin/gtts-cli -f ".$full_txt_path." -l 'it' -o ".$full_mp3_path;
exec($txt2mp3);

$full_mp3_file = str_replace("slow_", "", $full_mp3_path);
$speedfix = "/usr/bin/sox ".$full_mp3_path. " ".$full_mp3_file." tempo 1.17";
exec($speedfix);
exec("rm -rf ".$full_mp3_path);

?>