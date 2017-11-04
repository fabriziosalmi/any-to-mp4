## Bulk download images from Pixabay

This script will save 20 images from Pixabay to slides folder.

```
<?php

// change Pixabay API key with your own key
$keyword = $_GET["keyword"];
$url = "https://pixabay.com/api/?key=PIXABAY_API_KEY&q=".$keyword."&image_type=photo&pretty=true";
$response = file_get_contents($url);
$decoded = json_decode($response);
$i = 1;
$filename = "slide_";

foreach($decoded->hits as $id => $hit) {
	$image = $hit->webformatURL;
	$image_data = file_get_contents($image);
	file_put_contents("/tmp/slides/".$filename.$i.".jpg", $image_data);
	$i++;
}

?>
```
