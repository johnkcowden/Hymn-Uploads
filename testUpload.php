<?php
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

$bucket = 'choir.jhpinder.com';
$keyname = 'secret_hymn_uploads/testfile';

$s3 = new S3Client([
   'version'     => 'latest',
   'region'      => 'us-east-1',
   'profile'     => 'secondProfile'
]);

try {
   // Upload data.
   $result = $s3->putObject([
       'Bucket' => $bucket,
       'Key'    => $keyname,
       'Body'   => 'Hello, world!'
   ]);

   // Print the URL to the object.
   echo $result['ObjectURL'] . PHP_EOL;
} catch (S3Exception $e) {
   echo $e->getMessage() . PHP_EOL;
}
?>
