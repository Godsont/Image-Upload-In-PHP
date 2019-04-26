<?php 

require_once 'db.php';

$id = 15;

$db = new DB();
$currentProfilePic = $db->getProfilePic($id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
  <title>File Upload</title>
</head>

<body>

  <div class="container">
    <span class="userId">Id - <?php echo $id; ?></span>
    <h1>Please upload your image</h1>
    <form action="process.php" method="POST" enctype="multipart/form-data">
      <input type="file" name="profilePic">
      <input type="submit" name="submit" value="Upload">
      <input type="hidden" name="id" value="<?php echo $id ?>">
    </form>

    <div class="profilePicture">
      <img src="<?php echo $currentProfilePic['profilepic'] ?>" alt="Profile Picture">
    </div>
  </div>

</body>

</html>