<?php

$s3 = new Aws\S3\S3Client([
'version'     => 'latest',
'region'      => 'us-east-1',
'profile'     => 'secondProfile'
]);

$vidFile = $_FILES['video'];
echo __LINE__ . "\n";
exit();

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

}
?>
