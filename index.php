<?php
require 'vendor/autoload.php';

//use Aws\S3\S3Client;
//use Aws\S3\Exception\S3Exception;

$bucket = 'choir.jhpinder.com';
$keyname = 'secret_hymn_uploads/testfile';
//$credentials = new Aws\Credentials\Credentials('key', 'secret');
echo __LINE__ . "\n";

$s3 = new Aws\S3\S3Client([
'version'     => 'latest',
'region'      => 'us-east-1',
'profile'     => 'secondProfile'
]);
echo __LINE__ . "\n";


$vidFile = $_FILES['video'];
echo __LINE__ . "\n";
exit();
/*
if (isset($vidFile)) {

$errors= array();
echo __LINE__;
$file_name = $vidFile['name'];
echo __LINE__; 
$file_size =$vidFile['size'];
echo __LINE__;
$file_tmp =$vidFile['tmp_name'];
echo __LINE__;
$file_type=$vidFile['type'];
echo __LINE__;
$tmpFileExt = explode('.', $file_name);
echo __LINE__;
$file_ext=strtolower(end($tmpFileExt));
echo __LINE__;
$hymn = $_POST['hymn'];
echo __LINE__;
$fullname = $_POST['fullname'];
echo __LINE__;
$date = date("Y-m-d-H-i-s");
echo __LINE__;
$file_name_final = "hymn_" . $hymn . "_" . $fullname . "_";
echo __LINE__;
$file_name_final = $file_name_final . $date . "." . $file_ext;
echo __LINE__;
$vidFile['name'] = $file_name_final;

echo $vidFile['name'];
exit();
if($file_size > 1073741824){
$errors[]='File must not be larger than 1GB';
}


if (empty($errors)) {
try {
   // Upload data.
   $result = $s3->putObject([
       'Bucket' => $bucket,
       'Key'    => $keyname,
       'Body'   => $vidFile
   ]);
} catch (S3Exception $e) {
echo $e->getMessage();
}


// if(empty($errors)==true){
//   move_uploaded_file($file_tmp,'secret_hymn_uploads/' . $file_name_final);
//   echo "Success! Uploaded your file for hymn " . $hymn . ". Thanks " . $fullname . "!";
// } else {
//   echo "Failed to upload file! Contact James at jhpinder@gmail.com for guidance.";
// }
}
*/
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
<title>DFUMC Virtual Choir</title>
<body>

<h1>DFUMC Virtual Choir<br>Hymn Upload</h1>

<p>Step 1: Choose file. If you are on an iPhone or iPad, tap "Choose file" below, tap on the Photo Library button,
 find your video, select it, and wait until the "Compressing Video..." is complete. It will return you to this page once complete. <br><br>
  Step 2: Fill out hymn number and your name. <br><br>
  Step 3: Submit video and wait until it says "Success" at the top of the page. It may take a minute or two to upload the video. <br><br> </p>


  <form action="" method="POST" enctype="multipart/form-data" >

   <input type="file" name="video" accept="video/*,audio/*" value="Choose Video"/><br><br>

   <label for="hymn">Hymn Number:</label><br>
   <input type="text" name="hymn" id="hymn" style="font-size: 16; width: 150px"/><br><br>

   <label for="fullname">Your Name:</label><br>
   <input type="text" name="fullname" style="font-size: 16; width: 150px">

   <br><br><br>
   <input type="submit" value="Submit Video"/>
 </form>

</body>
</html>
