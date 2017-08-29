<?php

$base_path = "/mnt/test/pdf";
$path_pdf_in = $base_path."/in";
$path_txt_out = $base_path."/out";

$latest_pdf = 'ls -tr '.$path_pdf_in.' | head -n2 | tail -n1 | grep ".pdf"';
$latest_pdf_res = exec($latest_pdf);

$txt_filename = str_replace(".pdf", ".txt", $latest_pdf_res);

$full_pdf_path = $path_pdf_in."/".$latest_pdf_res;
$full_txt_path = $path_txt_out."/".$txt_filename;

$pdf2txt = "/usr/bin/pdftotext ".$full_pdf_path." ".$full_txt_path;
exec($pdf2txt);

?>