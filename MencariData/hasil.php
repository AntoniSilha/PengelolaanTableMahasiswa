<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian | Sistem Akademik</title>
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
            padding: 4rem 1rem;
            min-height: 100vh;
        }

        .container {
            background-color: var(--card-bg);
            border-radius: 24px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            width: 100%;
            max-width: 1000px;
            padding: 3rem;
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .header {
            text-align: center;
            margin-bottom: 3rem;
        }

        h2 {
            color: var(--text-main);
            font-size: 2rem;
            margin-bottom: 0.75rem;
            letter-spacing: -0.025em;
        }

        .search-info {
            display: inline-block;
            background-color: #eef2ff;
            color: var(--primary-color);
            padding: 0.625rem 1.5rem;
            border-radius: 9999px;
            font-size: 0.9rem;
            font-weight: 600;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .table-responsive {
            overflow-x: auto;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            margin-bottom: 2.5rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        thead {
            background-color: #f9fafb;
        }

        th {
            padding: 1.25rem 1.5rem;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            border-bottom: 1.5px solid var(--border-color);
        }

        td {
            padding: 1.25rem 1.5rem;
            font-size: 0.95rem;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-main);
        }

        tbody tr {
            transition: all 0.2s;
        }

        tbody tr:hover {
            background-color: #f5f3ff;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .badge-prodi {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background-color: #f3f4f6;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 500;
            color: #4b5563;
        }

        .empty-state {
            text-align: center;
            padding: 5rem 2rem;
            color: var(--text-muted);
        }

        .empty-icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            opacity: 0.5;
        }

        .footer-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            border-top: 1px solid var(--border-color);
            padding-top: 2.5rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.875rem 1.75rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 12px 20px -3px rgba(79, 70, 229, 0.4);
        }

        .btn-outline {
            background-color: #fff;
            color: var(--primary-color);
            border: 1.5px solid var(--primary-color);
        }

        .btn-outline:hover {
            background-color: #f5f3ff;
            transform: translateY(-2px);
        }
        
        .btn svg {
            margin-right: 0.75rem;
            width: 20px;
            height: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Hasil Pencarian</h2>
        <?php
        if (isset($_POST['submit'])) {
            $jenisCari = $_POST['jenisCari'];
            $dataCari  = $_POST['dataCari'];
            echo "<div class='search-info'>Mencari " . htmlspecialchars(ucfirst($jenisCari)) . ": <strong>" . htmlspecialchars($dataCari) . "</strong></div>";
        }
        ?>
    </div>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "kampus";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("<div class='empty-state'>⚠️ Koneksi database gagal: " . $conn->connect_error . "</div>");
    }

    if (isset($_POST['submit'])) {
        $jenisCari = $_POST['jenisCari'];
        $dataCari  = $_POST['dataCari'];

        $sql = "SELECT * FROM mahasiswa WHERE $jenisCari LIKE '%$dataCari%'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            echo "<div class='table-responsive'>";
            echo "<table>";
            echo "<thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama Lengkap</th>
                        <th>Program Studi</th>
                        <th>Kelas</th>
                        <th>Alamat</th>
                    </tr>
                  </thead>";
            echo "<tbody>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td style='font-family: monospace; font-weight: 600; color: #4f46e5;'>" . htmlspecialchars($row["nim"]) . "</td>
                        <td style='font-weight: 600;'>" . htmlspecialchars($row["nama"]) . "</td>
                        <td><span class='badge-prodi'>" . htmlspecialchars($row["prodi"]) . "</span></td>
                        <td style='text-align: center; font-weight: 700;'>" . htmlspecialchars($row["kelas"]) . "</td>
                        <td style='color: #6b7280;'>" . htmlspecialchars($row["alamat"]) . "</td>
                      </tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        } else {
            echo "<div class='empty-state'>
                    <div class='empty-icon'>🕵️‍♂️</div>
                    <h3>Tidak Ada Hasil</h3>
                    <p style='margin-top: 0.75rem;'>Kami tidak menemukan data yang cocok dengan kriteria Anda.</p>
                  </div>";
        }
    } else {
        echo "<div class='empty-state'>
                <div class='empty-icon'>🚀</div>
                <p>Silakan masukkan kata kunci untuk memulai.</p>
              </div>";
    }

    $conn->close();
    ?>

    <div class="footer-actions">
        <a href="cari.php" class="btn btn-outline">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali Cari
        </a>
        <a href="tambah.php" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Tambah Data
        </a>
    </div>
</div>

</body>
</html>