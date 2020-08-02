<?php

require 'hidden/keys.php';
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

$bucket = 'choir.jhpinder.com';
$keyname = 'secret_hymn_uploads/';

$s3 = new S3Client([
    'version'     => 'latest',
    'region'      => 'us-east-1',
    'credentials' => [
    'key'         => $key,
    'secret'      => $secret,
    ],
]);

if ($_FILES['video']['size'] == 0) { 
  $message = "Error occurred, please try selecting and uploading your file again. If this problem persists, contact James at jhpinder@gmail.com for guidance.";
} else {

  $vidFile = $_FILES['video'];
  $errors= array();
  $file_name = $vidFile['name']; 
  $file_size =$vidFile['size']; 
  $file_tmp =$vidFile['tmp_name']; 
  $file_type=$vidFile['type'];

  $tmpFileExt = explode('.', $file_name); 
  $file_ext=strtolower(end($tmpFileExt));
  $hymn = preg_replace('/[^0-9]/', '', $_POST['hymn']); 
  $fullname = $_POST['fullname'];
  $fullCleanName = preg_replace('/[^A-Za-z0-9\-]/', '', $fullname);
  $date = date("Y-m-d-H-i-s"); 
  $file_name_final = "hymn_" . $hymn . "_" . $fullCleanName . "_"; 
  $keyname = $keyname . $file_name_final . $date . "." . $file_ext;

  if ($file_size > 1073741824){
    $errors[]='File must not be larger than 1GB';
  }

  if (empty($errors)) {
    try {
      // Upload data.
      $result = $s3->putObject([
          'Bucket' => $bucket,
          'Key'    => $keyname,
          'SourceFile'   => $file_tmp,
      ]);
      $message = "Success! Uploaded your file for hymn " . $hymn . ". Thanks " . $fullname . "!";
    } catch (S3Exception $e) {
      echo $e->getMessage();
    }
  }
}
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
h2 {
  font-family: sans-serif;
  font-weight: normal;
  font-size: 22;
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

<body>

<h2><?php echo $message ?></h2>

</body>





</html>
