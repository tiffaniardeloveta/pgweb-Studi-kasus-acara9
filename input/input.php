<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.html");
    exit;
}

// Mengambil input sesuai dengan kolom tabel bank_sampah
$nama_bank = trim($_POST['nama_bank'] ?? '');
$alamat    = trim($_POST['alamat'] ?? '');
$latitude  = $_POST['latitude'] ?? '';
$longitude = $_POST['longitude'] ?? '';

// Validasi input: pastikan teks tidak kosong dan koordinat berupa angka
if (
    $nama_bank === '' ||
    $alamat === '' ||
    !is_numeric($latitude) ||
    !is_numeric($longitude)
) {
    die("Data tidak lengkap atau format tidak valid.");
}

// Koneksi ke database bank_sampah_jogja
$conn = new mysqli("localhost", "root", "", "bank_sampah_jogja");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query INSERT untuk tabel bank_sampah
$sql = "INSERT INTO bank_sampah (nama_bank, alamat, latitude, longitude) VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

// Binding parameter: "ssdd" -> string, string, double/float, double/float
$stmt->bind_param(
    "ssdd",
    $nama_bank,
    $alamat,
    $latitude,
    $longitude
);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    header("Location: ../index.php");
    exit;
} else {
    echo "Data gagal disimpan.";
    $stmt->close();
    $conn->close();
}
?>