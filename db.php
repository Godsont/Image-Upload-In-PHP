<?php 

class DB {
  private $conn;

  public function __construct() {
    try {
      $this->conn = new PDO('mysql:host=localhost;dbname=fileupload', 'root', '');
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
      die("Connection failed: " . $e->getMessage());
    }
  }

  // Inserting Image
  public function insertPic($id, $pic) {
    $query = "INSERT INTO profilepic (id, profilepic) VALUES (:id, :profilepic)";
    $statement = $this->conn->prepare($query);
    $statement->execute(['id' => $id, 'profilepic' => $pic]);
  }

  // Updating Image
  public function changePic($id, $pic) {
    $query = "UPDATE profilepic SET profilepic = :pic WHERE id = :id";
    $statement = $this->conn->prepare($query);
    $statement->execute(['id' => $id, 'pic' => $pic]);
  }

  // Fetching Image
  public function getProfilePic($id) {
    $query = "SELECT * FROM profilepic WHERE id = :id";
    $statement = $this->conn->prepare($query);
    $statement->execute(['id' => $id]);
    $data = $statement->fetch();
    return $data;
  }
}