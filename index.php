<?php
   if(isset($_FILES['video'])){
      $errors= array();
      $file_name = $_FILES['video']['name'];
      $file_size =$_FILES['video']['size'];
      $file_tmp =$_FILES['video']['tmp_name'];
      $file_type=$_FILES['video']['type'];
      $tmpFileExt = explode('.', $file_name);
      $file_ext=strtolower(end($tmpFileExt));
      $hymn = $_POST['hymn'];
      $fullname = $_POST['fullname'];
      $file_name_final = "hymn_" . $hymn . "_" . $fullname . "." . $file_ext;

      $extensions= array("mov", "mp4", "m4a", "mp3", "wav");

      // if(in_array($file_ext,$extensions)=== false){
      //    $errors[]="extension not allowed, please choose a .mov or a .mp4 file";
      // }

      if($file_size > 1073741824){
         $errors[]='File must not be larger than 1GB';
      }

      if(empty($errors)==true){
          move_uploaded_file($file_tmp,'secret_hymn_uploads/' . $file_name_final);
          //copy($file_tmp, 'C:/DFUMC');
          echo "Success! Uploaded your file for hymn " . $hymn . ". Thanks " . $fullname . "!";

      }else{
         //print_r($errors);
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
