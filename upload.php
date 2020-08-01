<?php

require 'vendor/autoload.php';

$bucket = 'choir.jhpinder.com';
$keyname = 'secret_hymn_uploads/';

$s3 = new Aws\S3\S3Client([
    'version'     => 'latest',
    'region'      => 'us-east-1',
    'profile'     => 'secondProfile'
]);

$vidFile = $_FILES['video'];

if (!isset($vidFile)) { 
  echo __LINE__ . PHP_EOL; 
}
$errors= array();
$file_name = $vidFile['name']; 
$file_size =$vidFile['size']; 
$file_tmp =$vidFile['tmp_name']; 
$file_type=$vidFile['type'];

$tmpFileExt = explode('.', $file_name); 
$file_ext=strtolower(end($tmpFileExt)); 
$hymn = $_POST['hymn']; 
$fullname = $_POST['fullname'];
$disallowed = array(" ", ".","/", "\\", "\,");
//$fullname = str_replace($disallowed, "", $fullname);
$date = date("Y-m-d-H-i-s"); 
$file_name_final = "hymn_" . $hymn . "_" . $fullname . "_"; 
$keyname = $keyname . $file_name_final . $date . "." . $file_ext;

if ($file_size > 1073741824){
  $errors[]='File must not be larger than 1GB';
}

$toUpload = base64_encode(file_get_contents($vidFile));

echo $toUpload . PHP_EOL;
echo $fullname . PHP_EOL;
print_r($_FILES);
if (empty($errors)) {
  try {
    // Upload data.
    echo __LINE__ . PHP_EOL; 
    $result = $s3->putObject([
        'Bucket' => $bucket,
        'Key'    => $keyname,
        'Body'   => $toUpload
    ]);
    echo __LINE__ . PHP_EOL; 
  } catch (Aws\S3\Exception\S3Exception $e) {
    echo $e->getMessage();
  }
}
?>
