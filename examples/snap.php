<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<style>
body {
margin: 0 auto;
background-color: #007bbf;
font-family: 'Open Sans', sans-serif;
font-size: 42px;
font-weight: bold;
}
.slide {
margin: 0 0;
height: 720px;
width: 1280px;
background-image: url("background.png");
color: #303030;
}
.container{
padding-top:20px;
padding-left:40px;
height:700px;
width:1240px;
}
.text{
display: table-cell;
vertical-align: middle;
margin-left:auto;
margin-right:auto;
width:1200px;
height:680px;
}
.text-shadow {
  text-shadow: 1px 1px 0 rgba(90,90,90,0.2) , -1px -1px 1px rgba(0,0,0,0.33) ;
}
.inset {
  background-color: black;
  color: transparent;
  text-shadow: 2px 2px 3px rgba(255,255,255,0.35);
   -webkit-background-clip: text;
          background-clip: text;
}
</style>
</head>
<body>
<div class="slide">
<div class="container">
<div class="text inset">
<?php
$snap = $_GET["snap"];
$snap_file = "/tmp/snaps/snap_".$snap.".txt";
$snap_text = file_get_contents($snap_file);
print_r($snap_text);
?>
</div>
</div>
</div>
</body>
</html>
