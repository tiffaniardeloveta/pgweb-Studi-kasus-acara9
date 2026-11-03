<?php
$id = $_GET['id'];

// Sesuaikan dengan setting MySQL Anda
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bank_sampah_jogja"; 

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query hapus data
$sql = "DELETE FROM bank_sampah WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    // Berhasil menghapus data, langsung redirect kembali ke index.php
    $conn->close();
    header("Location: index.php");
    exit();
} else {
    // Jika gagal, tampilkan pesan error
    echo "Error: " . $sql . "<br>" . $conn->error;
    $conn->close();
}
?>