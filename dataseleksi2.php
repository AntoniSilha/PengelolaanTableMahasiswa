<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="GET">
    Nama: <input type="text" name="nama">
    Prodi: <input type="text" name="prodi">
    Kecamatan: <input type="text" name="kecamatan">
    <button type="submit">Cari</button>
</form>
<hr>
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "kampus";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $nama = $_GET['nama'] ?? '';
    $prodi = $_GET['prodi'] ?? '';
    $kecamatan = $_GET['kecamatan'] ?? '';

    $sql = "SELECT * FROM mahasiswa WHERE 1=1";

    if (!empty($nama)) {
        $sql .= " AND nama LIKE '%$nama%'";
    }

    if (!empty($prodi)) {
        $sql .= " AND prodi LIKE '%$prodi%'";
    }

    if (!empty($kecamatan)) {
        $sql .= " AND alamat LIKE '%$kecamatan%'";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "NIM: " . $row["nim"]." | ".
                "Nama: " . $row["nama"]. " | " .
                "Prodi: " . $row["prodi"]." |   " .
                "Alamat: " . $row["alamat"]. "<br>";
        }
    } else {
        echo "0 results";
    }

    $conn->close();
?>
</body>
</html>