<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Seleksi Mahasiswa - Bootstrap</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        .header-bg {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            padding: 60px 0;
            color: white;
            margin-bottom: -50px;
        }
        .main-card {
            border: none;
            border-radius: 1.5rem;
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175);
            overflow: hidden;
        }
        .card-header-styled {
            background-color: white;
            border-bottom: 1px solid #edf2f7;
            padding: 2rem;
        }
        .table thead th {
            background-color: #f8fafc;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            font-weight: 700;
            color: #64748b;
            border-top: none;
        }
        .badge-prodi {
            background-color: #e0e7ff;
            color: #4338ca;
            font-weight: 600;
            padding: 0.5em 0.8em;
            border-radius: 0.5rem;
        }
        .btn-premium {
            border-radius: 0.75rem;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            transition: all 0.2s;
        }
        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-select-styled {
            border-radius: 0.75rem;
            padding: 0.6rem 1rem;
        }
    </style>
</head>

<body>

    <!-- Hero Header -->
    <div class="header-bg text-center">
        <div class="container text-white">
            <h1 class="display-4 fw-bold mb-2">Sistem Seleksi</h1>
            <p class="lead opacity-75">Manajemen Data Mahasiswa Terintegrasi</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card main-card">
                    <!-- Filter Section -->
                    <div class="card-header-styled">
                        <?php $prodi = isset($_GET['prodi']) ? $_GET['prodi'] : ""; ?>
                        
                        <form method="GET" class="row g-3 align-items-end justify-content-center">
                            <div class="col-md-5">
                                <label class="form-label fw-bold d-flex align-items-center gap-2 justify-content-center">
                                    <i data-lucide="filter" size="16"></i>
                                    Pilih Program Studi
                                </label>
                                <select name="prodi" class="form-select form-select-styled text-center">
                                    <option value="">-- Semua Prodi --</option>
                                    <option value="Teknologi Rekayasa Komputer" <?php if($prodi == 'Teknologi Rekayasa Komputer') echo 'selected'; ?>>Teknologi Rekayasa Komputer</option>
                                    <option value="Bisnis Digital" <?php if($prodi == 'Bisnis Digital') echo 'selected'; ?>>Bisnis Digital</option>
                                </select>
                            </div>
                            <div class="col-md-auto d-flex gap-2 justify-content-center">
                                <button type="submit" class="btn btn-primary btn-premium d-flex align-items-center gap-2">
                                    <i data-lucide="search" size="18"></i>
                                    Tampilkan
                                </button>
                                <?php if($prodi != ""): ?>
                                    <a href="dataseleksi.php" class="btn btn-outline-secondary btn-premium d-flex align-items-center gap-2">
                                        <i data-lucide="rotate-ccw" size="18"></i>
                                        Reset
                                    </a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>

                    <!-- Table Content -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "kampus";

                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            // Check connection
                            if ($conn->connect_error) {
                                echo "<div class='p-5 text-center text-danger'>
                                        <i data-lucide='alert-circle' size='48' class='mb-3'></i>
                                        <p>Connection failed: " . htmlspecialchars($conn->connect_error) . "</p>
                                      </div>";
                            } else {
                                // Prepare query
                                if ($prodi != "") {
                                    $prodi_safe = $conn->real_escape_string($prodi);
                                    $sql = "SELECT nim, nama, prodi FROM mahasiswa WHERE prodi = '$prodi_safe'";
                                } else {
                                    $sql = "SELECT nim, nama, prodi FROM mahasiswa";
                                }

                                $result = $conn->query($sql);

                                if ($result && $result->num_rows > 0) {
                                    echo "<table class='table table-hover mb-0'>";
                                    echo "<thead><tr><th class='ps-4 text-center'>NIM</th><th class='text-center'>Nama Lengkap</th><th class='pe-4 text-center'>Program Studi</th></tr></thead>";
                                    echo "<tbody>";
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr> ";
                                        echo "<td class='ps-4 align-middle text-primary fw-bold text-center'>" . htmlspecialchars($row["nim"]) . "</td>";
                                        echo "<td class='align-middle text-center'>" . htmlspecialchars($row["nama"]) . "</td>";
                                        echo "<td class='pe-4 align-middle text-center'><span class='badge badge-prodi'>" . htmlspecialchars($row["prodi"]) . "</span></td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
                                } else {
                                    echo "<div class='p-5 text-center text-muted'>";
                                    echo "<i data-lucide='database-zap' size='48' class='mb-3 opacity-25'></i>";
                                    echo "<p class='mb-0'>Tidak ada data mahasiswa ditemukan.</p>";
                                    echo "</div>";
                                }
                                $conn->close();
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize Lucide icons
        lucide.createIcons();
    </script>
</body>
</html>