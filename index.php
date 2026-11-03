<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Bank Sampah</title>
    <style>
        /* CSS Sederhana untuk Merapikan Kolom Tabel */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px 12px;
            text-align: left;
        }

        th {
            background-color: #ffe6f0; /* Warna pink lembut untuk header */
        }

        /* Warna selang-seling baris (opsional agar tidak terlalu polos) */
        tr:nth-child(even) {
            background-color: #fff5f8;
        }
    </style>
</head>
<body>

<h2>Data Tabel Bank Sampah DIY</h2>

<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "bank_sampah_jogja"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM bank_sampah";
$result = $conn->query($sql);

echo "<a href='input/index.html'>Input</a><br><br>";

if ($result && $result->num_rows > 0) {
    echo "<table>
    <tr>
        <th>id</th>
        <th>nama_bank</th>
        <th>alamat</th>
        <th>latitude</th>
        <th>longitude</th>
        <th colspan='2'>Aksi</th>
    </tr>";
    
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>".$row["id"]."</td>
            <td>".$row["nama_bank"]."</td>
            <td>".$row["alamat"]."</td>
            <td>".$row["latitude"]."</td>
            <td>".$row["longitude"]."</td>
            <td><a href='delete.php?id=".$row["id"]."' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?')\">hapus</a></td>
            <td><a href='edit/index.php?id=".$row["id"]."'>edit</a></td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>

</body>
</html>