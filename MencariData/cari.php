<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Mahasiswa | Sistem Akademik</title>
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
            padding: 1rem;
        }

        .container {
            background-color: var(--card-bg);
            border-radius: 20px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            width: 100%;
            max-width: 500px;
            padding: 3rem;
            animation: fadeIn 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo {
            background-color: #eef2ff;
            color: var(--primary-color);
            width: 64px;
            height: 64px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
        }

        h2 {
            font-size: 1.75rem;
            color: var(--text-main);
            margin-bottom: 0.5rem;
            letter-spacing: -0.025em;
        }

        .header p {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-main);
        }

        select, input[type="text"] {
            width: 100%;
            padding: 0.875rem 1.25rem;
            border-radius: 10px;
            border: 1.5px solid var(--border-color);
            background-color: #fff;
            font-size: 1rem;
            transition: all 0.2s ease;
            outline: none;
            color: var(--text-main);
        }

        select:focus, input[type="text"]:focus {
            border-color: var(--input-focus);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        .btn-group {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
            margin-top: 2rem;
        }

        button {
            width: 100%;
            padding: 1rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        button:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
        }

        button:active {
            transform: translateY(0);
        }

        .btn-outline {
            background-color: transparent;
            color: var(--primary-color);
            border: 1.5px solid var(--primary-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-outline:hover {
            background-color: #f5f3ff;
            border-color: var(--primary-hover);
            color: var(--primary-hover);
        }

        .icon {
            margin-right: 0.75rem;
            width: 20px;
            height: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <div class="logo">🎓</div>
        <h2>Cari Mahasiswa</h2>
        <p>Temukan data mahasiswa dengan cepat</p>
    </div>

    <form action="hasil.php" method="POST">
        <div class="form-group">
            <label for="jenisCari">Kategori Pencarian</label>
            <select name="jenisCari" id="jenisCari">
                <option value="nim">NIM</option>
                <option value="nama">Nama Lengkap</option>
                <option value="prodi">Program Studi</option>
                <option value="kelas">Kelas</option>
                <option value="alamat">Alamat</option>
            </select>
        </div>

        <div class="form-group">
            <label for="dataCari">Kata Kunci</label>
            <input type="text" name="dataCari" id="dataCari" placeholder="Contoh: Budi atau 3625..." required>
        </div>

        <div class="btn-group">
            <button type="submit" name="submit">
                <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Mulai Mencari
            </button>
            
            <a href="tambah.php" class="btn-outline">
                <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah Data Baru
            </a>
        </div>
    </form>
</div>

</body>
</html>