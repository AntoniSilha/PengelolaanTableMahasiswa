<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian Mahasiswa</title>
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --bg-color: #f3f4f6;
            --card-bg: #ffffff;
            --text-main: #1f2937;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            display: flex;
            justify-content: center;
            padding: 3rem 1rem;
            min-height: 100vh;
        }

        .container {
            background-color: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 900px;
            padding: 2.5rem;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
        }

        h2 {
            color: var(--text-main);
            font-size: 1.75rem;
            margin-bottom: 0.5rem;
        }

        .search-info {
            display: inline-block;
            background-color: #eef2ff;
            color: var(--primary-color);
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .table-responsive {
            overflow-x: auto;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            white-space: nowrap;
        }

        thead {
            background-color: #f9fafb;
        }

        th {
            padding: 1rem 1.5rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid var(--border-color);
        }

        td {
            padding: 1rem 1.5rem;
            font-size: 0.95rem;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-main);
        }

        tbody tr {
            transition: background-color 0.15s ease;
        }

        tbody tr:hover {
            background-color: #f9fafb;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--text-muted);
        }

        .empty-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #d1d5db;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-top: 2rem;
            padding: 0.75rem 1.5rem;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2);
        }

        .btn-back:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 6px 8px -1px rgba(79, 70, 229, 0.3);
        }
        
        .btn-back svg {
            margin-right: 0.5rem;
            width: 20px;
            height: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Hasil Pencarian Mahasiswa</h2>
        <?php
        if (isset($_POST['submit'])) {
            $jenisCari = $_POST['jenisCari'];
            $dataCari  = $_POST['dataCari'];
            echo "<div class='search-info'>Menampilkan hasil " . htmlspecialchars(ucfirst($jenisCari)) . ": <strong>" . htmlspecialchars($dataCari) . "</strong></div>";
        }
        ?>
    </div>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "kampus";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("<div class='empty-state'>Koneksi database gagal: " . $conn->connect_error . "</div>");
    }

    if (isset($_POST['submit'])) {
        $jenisCari = $_POST['jenisCari'];
        $dataCari  = $_POST['dataCari'];

        // Prepared statement logic equivalent for visual purposes (using the original SQL structure requested to remain unchanged logically)
        $sql = "SELECT * FROM mahasiswa WHERE $jenisCari LIKE '%$dataCari%'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            echo "<div class='table-responsive'>";
            echo "<table>";
            echo "<thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Prodi</th>
                        <th>Kelas</th>
                    </tr>
                  </thead>";
            echo "<tbody>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row["nim"]) . "</td>
                        <td style='font-weight: 500;'>" . htmlspecialchars($row["nama"]) . "</td>
                        <td>" . htmlspecialchars($row["prodi"]) . "</td>
                        <td>" . htmlspecialchars($row["kelas"]) . "</td>
                      </tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        } else {
            echo "<div class='empty-state'>
                    <div class='empty-icon'>🔍</div>
                    <h3>Data Tidak Ditemukan</h3>
                    <p style='margin-top: 0.5rem;'>Maaf, tidak ada mahasiswa yang sesuai dengan kata kunci yang Anda masukkan.</p>
                  </div>";
        }
    } else {
        echo "<div class='empty-state'>
                <div class='empty-icon'>ℹ️</div>
                <p>Silakan melakukan pencarian melalui form pencarian.</p>
              </div>";
    }

    $conn->close();
    ?>

    <div style="text-align: center;">
        <a href="cari.php" class="btn-back">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali Cari Data
        </a>
    </div>
</div>

</body>
</html>