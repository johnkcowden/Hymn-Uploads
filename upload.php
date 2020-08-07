<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
  echo "Error occurred, please try selecting and uploading your file again. If this problem persists, contact James at jhpinder@gmail.com for guidance.";
  exit();
}

// echo "got past file check, name is " . $_POST['fullname'] . PHP_EOL;
// print_r($_FILES['video']);
// exit();

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
?>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<head>
<title>DFUMC Virtual Choir</title>
<link rel="icon" href="umhLogoWhite.png" type="image/x-icon">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<style media="screen">
.bg-light-1 {
background: #f3f3f3 !important;
}

.display-5 {
  font-size: 2.5rem;
  font-weight: 300;
  line-height: 1.2;
}

.display-6 {
  font-size: 2.2rem;
  font-weight: 300;
  line-height: 1.2;
}
</style>
</head>

<body>


<nav class="navbar navbar-expand-sm navbar-light bg-light border-bottom mb-3">
<a class="navbar-brand" href="#">DFUMC Virtual Choir</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="navbar-nav mr-auto">
<li class="nav-item">
<a class="nav-link" href="..">Hymn Uploader</a>
</li>
<li class="nav-item">
<a class="nav-link" href="../hymnal">Hymn Sheets</a>
</li>
</ul>
</div>
</nav>


<div class="container py-3 my-3">
<div class="display-6">Thanks for uploading!</div>
</div>

<!-- DO NOT TOUCH!!!!! -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>

</html>
