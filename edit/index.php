<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Form Edit Bank Sampah</title>
</head>
<body>
<h2>Form Edit Data Bank Sampah</h2>
<?php
    // Sesuaikan dengan setting MySQL
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "bank_sampah_jogja";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Pengecekan parameter ID di URL agar tidak crash saat diakses langsung
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM bank_sampah WHERE id = $id";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            echo "<form action='edit.php' onsubmit='return validateForm(event)' method='post'>";
            while($row = $result->fetch_assoc()) {
                echo "<input type='hidden' name='id' value='".$row['id']."'><br>";
                echo "<label for='nama_bank'>Nama Bank Sampah:</label><br>";
                echo "<input type='text' id='nama_bank' name='nama_bank' value='".$row['nama_bank']."'><br>";
                echo "<label for='alamat'>Alamat:</label><br>";
                echo "<input type='text' id='alamat' name='alamat' value='".$row['alamat']."'><br>";
                echo "<label for='latitude'>Latitude:</label><br>";
                echo "<input type='text' id='lat' name='latitude' value='".$row['latitude']."'><br>";
                echo "<label for='longitude'>Longitude:</label><br>";
                echo "<input type='text' id='long' name='longitude' value='".$row['longitude']."'><br><br>";
            }
            echo "<input type='submit' value='Submit'>";
            echo "</form>";
        } else {
            echo "Data tidak ditemukan.";
        }
    } else {
        echo "Error: ID tidak ditemukan di URL. Silakan kembali ke tabel utama dan klik tombol Edit.";
    }

    $conn->close();
?>
<p id="informasi" style="color: red;"></p>
<script>
    function validateForm(event) {
        let namaBank = document.getElementById("nama_bank").value.trim();
        let alamat   = document.getElementById("alamat").value.trim();
        let latitude = document.getElementById("lat").value;
        let longitude= document.getElementById("long").value;
        let text = "";

        if (namaBank === "") {
            text = "Nama Bank Sampah harus diisi.";
        } else if (alamat === "") {
            text = "Alamat harus diisi.";
        } else if (latitude === "" || isNaN(latitude) || latitude < -90 || latitude > 90) {
            text = "Latitude harus angka antara -90 dan 90.";
        } else if (longitude === "" || isNaN(longitude) || longitude < -180 || longitude > 180) {
            text = "Longitude harus angka antara -180 dan 180.";
        }

        if (text !== "") {
            event.preventDefault();
            document.getElementById("informasi").innerHTML = text;
            return false;
        }
        return true;
    }
</script>
</body>
</html>