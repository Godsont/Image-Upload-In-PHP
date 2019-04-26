<?php 

require_once 'db.php';

$db = new DB();

if(isset($_POST['submit'])) {
  $id = $_POST['id'];
  $profilePic = $_FILES['profilePic'];

  // Creating the necessary variables for Temp Filename and Target Filename

  $tempFileName = $_FILES['profilePic']['tmp_name'];
  $fileType = pathinfo($_FILES['profilePic']['name'], PATHINFO_EXTENSION);
  $fileName = uniqid('gt-') . '.' . $fileType;
  $targetPath = 'img/' . $fileName;

  // echo "Id: " . $id . "<br>";
  // echo "Temp Filename: " . $tempFileName . "<br>";
  // echo "File Type: " . $fileType . "<br>";
  // echo "Target File Name: " . $fileName . "<br>";
  // echo "Target path: " . $targetPath . "<br>";

  $data = checkExistingPic($id, $db);

  // Copy the image file to the server

  if(move_uploaded_file($tempFileName, $targetPath)) {
    if(!$data) {
      $db->insertPic($id, $targetPath);
      header('Location: index.php');
    } else {
      unlink($data['profilepic']);
      $db->changePic($id, $targetPath);
      header('Location: index.php');
    }
  } else {
    echo "Problem uploading image";
  }
}


// Check whether profile pic already exists

function checkExistingPic($id, $db) {
  return $db->getProfilePic($id);
}