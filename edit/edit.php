<?php
// Semak sekiranya data dihantar melalui borang (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id        = $_POST['id'];
    $nama_bank = $_POST['nama_bank'];
    $alamat    = $_POST['alamat'];
    $latitude  = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Tetapan sambungan MySQL
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "bank_sampah_jogja"; 

    // Cipta sambungan
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Semak sambungan
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Kemaskini query UPDATE mengikut jadual bank_sampah
    $sql = "UPDATE bank_sampah SET 
            nama_bank='$nama_bank', 
            alamat='$alamat', 
            latitude=$latitude, 
            longitude=$longitude 
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
    }
} else {
    echo "Akses ditolak. Sila hantar data melalui borang Edit.";
}
?>