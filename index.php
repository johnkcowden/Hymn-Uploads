<?php
require 'vendor/autoload.php';

//use Aws\S3\S3Client;
//use Aws\S3\Exception\S3Exception;

$bucket = 'choir.jhpinder.com';
$keyname = 'secret_hymn_uploads/testfile';
//$credentials = new Aws\Credentials\Credentials('key', 'secret');


?>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minumum-scale=.5">
<style media="screen">
html {
max-width: 100%;
overflow-x: hidden;
}
body {
background-image: linear-gradient(to top, #4CA1AF, #C4E0E5);
max-width: 100%;
overflow-x: hidden;
}

h1 {
font-family: sans-serif;
font-weight: normal;
font-size: 30
}
p {
font-family: sans-serif;
font-size: 18
}
label {
font-size: 18;
font-family: sans-serif;
}
input {
font-size: 18;
}


</style>
<head>
  <title>DFUMC Virtual Choir</title>
  <link rel = "icon" href = "umhLogoWhite.png"
  type = "image/x-icon">
</head>
<body>

<h1>DFUMC Virtual Choir<br>Hymn Upload</h1>

<p>Step 1: Choose file. If you are on an iPhone or iPad, tap "Choose file" below, tap on the Photo Library button,
 find your video, select it, and wait until the "Compressing Video..." is complete. It will return you to this page once complete. <br><br>
  Step 2: Fill out hymn number and your name. <br><br>
  Step 3: Submit video and wait until it says "Success" at the top of the page. It may take a minute or two to upload the video. <br><br> </p>


  <form action="upload.php" method="POST" enctype="multipart/form-data" >

   <input type="file" name="video" required="required" accept="video/*,audio/*" value="Choose Video"/><br><br>

   <p>Hymn Number:</p>
   <!--<input type="text" name="hymn" id="hymn" style="font-size: 16; width: 150px"/><br><br>
-->
   <input type="radio" required="required" name="hymn" id="hymn0" value="152" checked/>
   <label for="hymn0">152</label><br><br>
   <input type="radio" required="required" name="hymn" id="hymn1" value="474"/>
   <label for="hymn1">474</label><br><br>
   <input type="radio" required="required" name="hymn" id="hymn2" value="593"/>
   <label for="hymn2">593</label><br><br><br>

   <label for="fullname">Your Name:</label><br>
   <input type="text" name="fullname" maxlength="30" required="required" style="font-size: 16; width: 150px">

   <br><br><br>
   <input type="submit" onclick="this.form.submit();this.disabled = true" value="Submit Video"/>
 </form>

</body>
</html>
