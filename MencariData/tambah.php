<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa | Sistem Akademik</title>
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --bg-color: #f3f4f6;
            --card-bg: #ffffff;
            --text-main: #1f2937;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
            --input-focus: #4f46e5;
            --success: #10b981;
            --error: #ef4444;
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
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 3rem 1rem;
        }

        .container {
            background-color: var(--card-bg);
            border-radius: 24px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            width: 100%;
            max-width: 600px;
            padding: 3rem;
            animation: fadeIn 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        .header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        h2 {
            font-size: 2rem;
            color: var(--text-main);
            margin-bottom: 0.5rem;
            letter-spacing: -0.025em;
        }

        .header p {
            color: var(--text-muted);
            font-size: 1rem;
        }

        .alert {
            padding: 1.25rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            font-weight: 500;
            text-align: center;
            animation: slideIn 0.4s ease-out;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .alert-success {
            background-color: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background-color: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .full-width {
            grid-column: span 2;
        }

        label {
            display: block;
            margin-bottom: 0.625rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-main);
        }

        select, input[type="text"] {
            width: 100%;
            padding: 0.875rem 1.25rem;
            border-radius: 12px;
            border: 1.5px solid var(--border-color);
            background-color: #fff;
            font-size: 1rem;
            transition: all 0.2s ease;
            outline: none;
        }

        select:focus, input[type="text"]:focus {
            border-color: var(--input-focus);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        .btn-submit {
            width: 100%;
            padding: 1.125rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 1rem;
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
        }

        .btn-submit:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 15px 20px -3px rgba(79, 70, 229, 0.4);
        }

        .btn-back {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 2rem;
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .btn-back:hover {
            color: var(--primary-color);
        }

        .icon {
            margin-right: 0.75rem;
            width: 20px;
            height: 20px;
        }

        @media (max-width: 640px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            .full-width {
                grid-column: span 1;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Tambah Mahasiswa</h2>
        <p>Silakan isi formulir data mahasiswa baru</p>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "kampus";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            echo "<div class='alert alert-error'>⚠️ Koneksi gagal: " . $conn->connect_error . "</div>";
        } else {
            $nim = $conn->real_escape_string($_POST['nim']);
            $nama = $conn->real_escape_string($_POST['nama']);
            $prodi = $conn->real_escape_string($_POST['prodi']);
            $kelas = $conn->real_escape_string($_POST['kelas']);
            $alamat = $conn->real_escape_string($_POST['alamat']);

            // Fixed SQL and variable logic
            $sql = "INSERT INTO mahasiswa (nim, nama, prodi, kelas, alamat) VALUES ('$nim', '$nama', '$prodi', '$kelas', '$alamat')";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>✅ Data berhasil disimpan ke sistem!</div>";
            } else {
                echo "<div class='alert alert-error'>❌ Gagal menyimpan: " . $conn->error . "</div>";
            }
            $conn->close();
        }
    }
    ?>

    <form action="tambah.php" method="POST">
        <div class="form-grid">
            <div class="form-group full-width">
                <label for="nim">Nomor Induk Mahasiswa (NIM)</label>
                <input type="text" name="nim" id="nim" placeholder="Masukkan NIM 12 digit" required>
            </div>

            <div class="form-group full-width">
                <label for="nama">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" placeholder="Masukkan nama sesuai KTP" required>
            </div>

            <div class="form-group">
                <label for="prodi">Program Studi</label>
                <select name="prodi" id="prodi" required>
                    <option value="" disabled selected>Pilih Prodi</option>
                    <option value="Teknologi Rekayasa Komputer">Teknologi Rekayasa Komputer</option>
                    <option value="Bisnis Digital">Bisnis Digital</option>
                    <option value="Teknologi Rekayasa Perangkat Lunak">Teknologi Rekayasa Perangkat Lunak</option>
                </select>
            </div>

            <div class="form-group">
                <label for="kelas">Kelas</label>
                <input type="text" name="kelas" id="kelas" placeholder="Contoh: 1E" required>
            </div>

            <div class="form-group full-width">
                <label for="alamat">Alamat Lengkap</label>
                <input type="text" name="alamat" id="alamat" placeholder="Masukkan alamat domisili" required>
            </div>
        </div>

        <button type="submit" name="submit" class="btn-submit">
            <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
            </svg>
            Simpan Data Mahasiswa
        </button>
    </form>

    <a href="cari.php" class="btn-back">
        <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Kembali ke Beranda
    </a>
</div>

</body>
</html>