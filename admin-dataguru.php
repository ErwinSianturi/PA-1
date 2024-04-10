<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Guru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }
        .card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            width: 300px;
            padding: 20px;
        }
        .card h3 {
            margin-top: 0;
        }
        .card p {
            margin: 5px 0;
        }
        .card img {
            width: 100%;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pa1";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT Nama, NIP, Jabatan, Photo FROM DataGuru";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo "<div class='card'>
                <img src='" . $row["Photo"]. "' alt='Teacher Photo'>
                <h3>" . $row["Nama"]. "</h3>
                <p>NIP: " . $row["NIP"]. "</p>
                <p>Jabatan: " . $row["Jabatan"]. "</p>
              </div>";
      }
    } else {
      echo "0 results";
    }
    $conn->close();
    ?>
</div>

</body>
</html>
