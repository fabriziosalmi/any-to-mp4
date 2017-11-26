<?php
// functions
function generateRandomString($length = 32) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $random;
}
function mp3speed($mp3_original, $mp3_mixed) {
    $mix = "/usr/bin/sox ".$mp3_original. " ".$mp3_mixed." tempo 1.13";
    exec($mix);
}

// text input
$txt = "buongiorno a tutti";
// setup
$in_txt = "tmp/input.txt";
$apv_txt = "tmp/output.txt";
$apv_ssml = "tmp/output.ssml";
$mp3_mix = "tmp/output.mp3";
// process
file_put_contents($in_txt, utf8_encode($txt));
$random = generateRandomString();
$mp3_name = $random.".mp3";
$mp3_out = "mp3/".$mp3_name;
$apv = "Carla"; // Giorgio
$cmd1 = "tweak-txt.pl ".$in_txt." > ".$apv_txt;
exec($cmd1);
$cmd2 = "txt2ssml.pl ".$apv_txt." > ".$apv_ssml;
exec($cmd2);
$cmd3 = "ssml2mp3.py -o ". $mp3_mix." --voice ".$apv." ".$apv_ssml;
exec($cmd3);
mp3speed($mp3_mix, $mp3_out);
exec("rm tmp/input.txt tmp/output.txt tmp/output.ssml tmp/output.mp3");
// output mp3 file
echo "Audio: ".$mp3_out."\n";

?>
