<?php

echo "hymn: " . $_POST['hymn'] . PHP_EOL;
echo "name: " . $_POST['fullname'] . PHP_EOL;
echo "filename: " . $_FILES['video']['name'] . " "; 
print_r($_FILES);
?>
