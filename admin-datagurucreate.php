<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menambahkan Data Guru</title>
    
</head>
<body>

<h2>Menambahkan Data Guru</h2>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pa1";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

   
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

    
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

   
    if (file_exists($targetFile)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }

    
    if ($_FILES["image"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }

    
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }

    
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
   
    } else {
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
        

        $nama = $_POST['nama'];
        $nip = $_POST['nip'];
        $jabatan = $_POST['jabatan'];

        $sql = "INSERT INTO DataGuru (Nama, NIP, Jabatan, Photo) VALUES ('$nama', '$nip', '$jabatan', '$targetFile')";

        if ($conn->query($sql) === TRUE) {
          echo "New record created successfully";
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }

        
        $conn->close();
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <label for="nama">Nama:</label><br>
    <input type="text" id="nama" name="nama"><br><br>

    <label for="nip">NIP:</label><br>
    <input type="text" id="nip" name="nip"><br><br>

    <label for="jabatan">Jabatan:</label><br>
    <input type="text" id="jabatan" name="jabatan"><br><br>

    <label for="image">Upload Picture:</label><br>
    <input type="file" id="image" name="image"><br><br>

    <input type="submit" value="Submit">
</form>

</body>
</html>
