<?php
// Angka yang diinginkan untuk tampilan
$ordersReceived = 10;
$ordersInProcess = 5;
$ordersShipped = 2;
$productCount = 2;
$uecBalance = 400000;
$receivedBalance = 200000;

// Data pesanan yang akan ditampilkan, meniru struktur dari gambar
$orders = [
    [
        'buyer_section_title' => 'Andreas - 412202002', // Menggunakan buyer_section_title untuk header grup
        'order_title' => 'Boba Melekat Kayak Kamu #UEC0108',
        'item_description' => 'Jelly, Medium - (4x 12.000)',
        'item_price_per_unit' => '12.000', // Harga per unit/paket kecil
        'date' => '30-03-2025',
        'money_status' => 'Ditarik Ke Seller',
        'item_status' => 'Sudah Diambil',
        'grand_total_display' => '48.000', // Total keseluruhan untuk pesanan ini
        'action_button' => null // Tidak ada tombol aksi untuk pesanan ini
    ],
    [
        'buyer_section_title' => 'Hendi -',
        'order_title' => 'Boba Melekat Kayak Kamu #UEC0109',
        'item_description' => 'Jelly, Large - (1x 15.000)',
        'item_price_per_unit' => '15.000', // Harga per unit/paket kecil
        'date' => '30-03-2025',
        'money_status' => 'Masih di UEC',
        'item_status' => 'Barang Belum Diambil',
        'grand_total_display' => '15.000', // Total keseluruhan untuk pesanan ini
        'action_button' => 'Ajukan Penarikan Dana' // Ada tombol aksi untuk pesanan ini
    ]
];

// Informasi pagination
$total_results = 50;
$displayed_results = count($orders);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ukrida E-Commerce Seller Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
            color: #333;
            line-height: 1.6;
        }

        /* --- Bagian Navigasi Paling Atas (gambar pertama: image_16aff3.png) --- */
        .navbar-top-first {
            display: flex;
            background-color: #fff;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            justify-content: center;
            /* Mengatur agar elemen berada di tengah */
            flex-wrap: wrap;
            gap: 25px;
            /* Jarak antar tautan lebih besar */
            border-bottom: 1px solid #eee;
        }


        .navbar-top-first a {
            text-decoration: none;
            color: #333;
            padding: 8px 0;
            font-size: 15px;
            font-weight: 500;
            white-space: nowrap;
            /* Pastikan tidak memecah baris */
        }

        .navbar-top-first a:hover {
            color: #007bff;
        }

        /* --- Bagian Header Bar Kedua (gambar kedua: Screenshot 2025-06-05 114502.png, dimodifikasi) --- */
        .header-bar-second {
            background-color: #fff;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: sticky;
            /* Tetap di atas saat digulir */
            top: 0;
            /* Menempel di bagian atas viewport */
            z-index: 999;
            /* Pastikan di bawah navbar-top-first */
        }

        .header-bar-second .logo-container {
            display: flex;
            align-items: center;
            flex-shrink: 0;
            margin-right: 20px;
            /* Memberi sedikit jarak dari search bar */
        }

        .header-bar-second .logo-container img {
            height: 75px;
            /* Sesuaikan tinggi logo sesuai kebutuhan */
            width: auto;
            /* Jaga aspek rasio */
            /* margin-right: 10px; Jika ingin ada jarak antara logo dan teks (jika teks tetap ada) */
        }

        .header-bar-second .search-bar-wrapper {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            margin: 0 20px;
        }

        .header-bar-second .search-bar {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 50px;
            padding: 5px 15px;
            background-color: #fff;
            max-width: 600px;
            width: 100%;
            position: relative;
            height: 38px;
        }

        .header-bar-second .search-bar input {
            border: none;
            outline: none;
            width: 100%;
            padding: 0;
            background: transparent;
            font-size: 0.95em;
            color: #333;
        }

        .header-bar-second .search-bar input::placeholder {
            color: #999;
        }

        .header-bar-second .search-bar .clear-search {
            position: absolute;
            right: 15px;
            color: #888;
            cursor: pointer;
            font-size: 1em;
            font-weight: normal;
        }

        .header-bar-second .logout-btn {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 8px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.95em;
            font-weight: normal;
            text-decoration: none;
            white-space: nowrap;
            transition: background-color 0.2s ease-in-out;
            flex-shrink: 0;
            margin-left: 20px;
            /* Memberi jarak dari search bar */
        }

        .header-bar-second .logout-btn:hover {
            background-color: #555;
        }

        /* --- Konten Utama Dashboard --- */
        .dashboard-main-content {
            padding: 20px;
            max-width: 1200px;
            margin: 20px auto;
            background-color: #f0f2f5;
        }

        /* --- Bagian Header Dashboard (Selamat Datang, Seller! Dashboard - image_16ac8d.png) --- */
        .dashboard-header-section {
            background-color: #d1d1d1;
            padding: 20px;
            margin-bottom: 20px;
            color: #333;
            border-radius: 4px;
        }

        .dashboard-header-section h2 {
            margin: 0;
            font-size: 24px;
            color: #333;
            font-weight: 600;
        }

        .dashboard-header-section p {
            margin-top: 5px;
            font-size: 18px;
            color: #333;
            font-weight: normal;
        }

        /* --- GRID STATISTIK (image_16ac8d.png) --- */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background-color: #fff;
            padding: 15px;
            border-radius: 4px;
            text-align: left;
            min-height: 80px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .stat-card h3 {
            margin-top: 0;
            margin-bottom: 5px;
            color: #555;
            font-size: 0.9em;
            font-weight: normal;
        }

        .stat-card .stat-number {
            font-size: 1.8em;
            font-weight: bold;
            color: #333;
            margin: 0;
        }

        /* --- Bagian Pesanan Dikirim Styling (dari image_315db3.png) --- */
        .container {
            width: 100%;
            /* Lebar yang lebih sesuai dengan gambar */
            margin: 20px auto;
            background-color: #fff;
            /* Container utama untuk area pesanan dikirim */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .filter-bar {
            width: 100%;
            display: flex;
            flex-direction: column;
            /* Ubah ke kolom untuk tata letak vertikal */
            align-items: flex-start;
            /* Sejajarkan ke kiri */
            padding: 20px;
            background-color: #f0f2f5;
            /* Warna latar belakang sama dengan body */
            margin: 0 auto;
            border-bottom: 1px solid #ddd;
            border-radius: 8px 8px 0 0;
            /* Sesuaikan radius pojok atas */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            /* Tambahkan shadow */
        }

        .filter-bar .title-main {
            font-size: 24px;
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }

        .filter-bar .sort-section {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            /* Jarak antar elemen */
        }

        .filter-bar .sort-section span {
            font-size: 14px;
            color: #666;
            white-space: nowrap;
        }

        .filter-bar .filter-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .filter-bar button {
            padding: 8px 15px;
            border: 1px solid #ddd;
            border-radius: 20px;
            background-color: #fff;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            transition: all 0.2s ease;
            white-space: nowrap;
            /* Pastikan teks tidak pecah */
        }

        .filter-bar button.active {
            background-color: #e0f2f7;
            /* Light blue for active */
            border-color: #2196f3;
            /* Blue border for active */
            color: #2196f3;
            font-weight: bold;
        }

        .filter-bar button.active svg {
            fill: #2196f3;
            /* Warna ikon sesuai dengan teks aktif */
        }

        .filter-bar button.small-btn {
            padding: 5px 12px;
            /* Lebih kecil */
            line-height: 1.2;
            /* Menyesuaikan tinggi baris untuk teks 2 baris */
            flex-direction: column;
            /* Agar teks Saldo<br>Diterima bisa 2 baris */
            align-items: center;
            /* Pusatkan secara horizontal */
            justify-content: center;
            height: auto;
            /* Biarkan tinggi menyesuaikan konten */
        }

        .filter-bar button.small-btn span {
            font-size: 13px;
            /* Ukuran font lebih kecil untuk small-btn */
            color: inherit;
            /* Ikuti warna parent */
            text-align: center;
        }

        .filter-bar button svg {
            margin-left: 5px;
            /* Jarak ikon dari teks */
            height: 16px;
            width: 16px;
            stroke-width: 2;
            /* Atur stroke-width untuk ikon */
            fill: none;
            /* Pastikan fill tidak ada untuk ikon garis */
            stroke: #666;

            /* Warna default ikon */
        }

        .filter-bar button.active svg {
            stroke: #2196f3;
            /* Warna ikon aktif */
        }

        .buyer-section-title {
            font-weight: bold;
            font-size: 16px;
            margin-top: 25px;
            margin-bottom: 10px;
            color: #555;
        }

        .order-card {
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            background-color: #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .order-card-content {
            display: flex;
            align-items: flex-start;
            gap: 15px;
        }

        .placeholder-image {
            width: 70px;
            height: 70px;
            background-color: #e0e0e0;
            border-radius: 4px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #a0a0a0;
            font-size: 12px;
            flex-shrink: 0;
        }

        .order-details-text {
            /* Mengubah nama kelas dari order-details untuk menghindari konflik */
            flex-grow: 1;
        }

        .order-title-text {
            /* Mengubah nama kelas dari order-title untuk menghindari konflik */
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 15px;
        }

        .detail-line {
            font-size: 13px;
            color: #666;
            margin-bottom: 3px;
        }

        .grand-total-section {
            /* Kelas baru untuk div total dan tombol */
            text-align: right;
            font-weight: bold;
            font-size: 16px;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px dashed #eee;
        }

        .action-button {
            background-color: #2196f3;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
            margin-top: 10px;
            /* Untuk menempatkan tombol di kanan */
        }

        .action-button:hover {
            background-color: #1976d2;
        }

        .footer-info {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }

        .clear-fix::after {
            content: "";
            display: table;
            clear: both;
        }

        /* Style untuk tombol "Kembali Ke Menu Utama" */
        .d-flex {
            display: flex;
        }

        .justify-content-center {
            justify-content: center;
        }

        .mt-4 {
            margin-top: 1.5rem;
            /* 1.5 * 16px = 24px */
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .btn-secondary {
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            color: #fff;
            background-color: #5c636a;
            border-color: #565e64;
        }

        .container-body {
            padding: 1.25em 5em
        }


        /* --- Responsive adjustments --- */
        @media (max-width: 992px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .navbar-top-first a {
                margin-right: 15px;
                font-size: 14px;
            }

            .container-body {
                padding: 1.25em
            }
        }

        @media (max-width: 768px) {
            .navbar-top-first {
                flex-direction: column;
                align-items: flex-start;
                padding: 10px 15px;
                gap: 5px;
            }

            .navbar-top-first a {
                margin-right: 0;
            }

            .header-bar-second {
                flex-direction: column;
                padding: 15px;
                align-items: flex-start;
            }

            .header-bar-second .logo-container {
                margin-bottom: 15px;
                width: 100%;
                align-items: center;
                margin-right: 0;
            }

            .header-bar-second .search-bar-wrapper {
                width: 100%;
                margin: 0 0 15px 0;
            }

            .header-bar-second .search-bar {
                width: 100%;
                max-width: none;
            }

            .header-bar-second .logout-btn {
                width: 100%;
                margin-left: 0;
            }

            .dashboard-header-section {
                padding: 15px 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .stat-card {
                padding: 15px;
            }

            .order-card {
                /* Sesuaikan untuk order-card juga */
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .order-card-content {
                flex-direction: column;
                align-items: center;
                text-align: center;
                width: 100%;
                /* Agar konten memenuhi lebar saat column */
            }

            .placeholder-image {
                margin-right: 0;
                margin-bottom: 15px;
            }

            .grand-total-section {
                width: 100%;
                text-align: center;
                /* Pusatkan total dan tombol */
            }

            .action-button {
                float: none;
                /* Hapus float */
                margin-top: 15px;
                width: 80%;
                /* Beri lebar agar lebih mudah diklik */
                margin-left: auto;
                margin-right: auto;
                display: block;
                /* Agar margin auto bekerja */
            }

            .filter-bar {
                padding: 15px;
            }

            .filter-bar .sort-section {
                flex-direction: column;
                align-items: flex-start;
            }

            .container-body {
                padding: 1.25em
            }
        }
    </style>
</head>

<body>
    <header class="header-bar-second">
        <div class="logo-container">
            <img src="uec-edit.png" alt="Ukridda E-Commerce Logo">
        </div>
        <div class="search-bar-wrapper">
            <div class="search-bar">
                <input type="text" placeholder="Cari di Sini">
                <span class="clear-search" onclick="this.previousElementSibling.value=''">X</span>
            </div>
        </div>
        <a href="logout.php" class="logout-btn">Logout</a>
    </header>

    <div class="navbar-top-first">
        <a href="home.php">Home</a>
        <a href="daftar_produk.php">Daftar Produk</a>
        <a href="edit_produk.php">Edit Produk</a>
        <a href="pesanan_dikirim_disortir.php">Pesanan Dikirim</a>
        <a href="pesanan_masuk.php">Pesanan Masuk</a>
        <a href="proses_pesanan.php">Proses Pesanan</a>
        <a href="tambah_produk.php">Tambah Produk</a>
    </div>

    <div class="container-body">
        <div class="filter-bar">
            <div class="title-main">Pesanan Dikirim</div>
            <div class="sort-section">
                <span>Sortir Berdasarkan:</span>
                <div class="filter-buttons">
                    <button class="active">
                        Bulan
                        <!-- <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M11 20H6c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2h12c1.1 0 2 .9 2 2v5h-2V6H6v12h5l-2 2zm10.79-9.01l-1.42-1.42c-.2-.2-.51-.2-.71 0L17.7 11.23 15.86 9.39l1.42-1.42c.2-.2.51-.2.71 0l2.12 2.12c.2.2.2.51 0 .71l-1.42 1.42c-.2.2-.51.2-.71 0zM19 14.99V13h-2v1.99l-2.4 2.4c-.2.2-.2.51 0 .71l1.42 1.42c.2.2.51.2.71 0L19 18.01v2.98h2v-2.98l2.4-2.4c.2-.2.2-.51 0-.71l-1.42-1.42c-.2-.2-.51-.2-.71 0z" />
                    </svg> -->
                    </button>
                    <button>
                        Total
                        <!-- <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px">
                        <path d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-.5-5h1c.28 0 .5-.22.5-.5V10c0-.55-.45-1-1-1h-.5V7h-1v2H9c-.55 0-1 .45-1 1v4c0 .55.45 1 1 1h2.5c.28 0 .5-.22.5-.5v-1c0-.28-.22-.5-.5-.5h-1c-.28 0-.5.22-.5.5v.5zm0-2h1v-.5h-1v.5z" />
                    </svg> -->
                    </button>
                    <button>
                        Saldo&nbsp;Diterima
                    </button>
                    <button>
                        Saldo&nbsp;di&nbsp;UEC
                    </button>
                </div>
            </div>
        </div>

        <div class="container">
            <?php foreach ($orders as $order): ?>
                <div class="buyer-section-title">
                    <?php echo htmlspecialchars($order['buyer_section_title']); ?>
                </div>
                <div class="order-card clear-fix">
                    <div class="order-card-content">
                        <div class="placeholder-image">
                        </div>
                        <div class="order-details-text">
                            <div class="order-title-text"><?php echo htmlspecialchars($order['order_title']); ?></div>
                            <div class="detail-line">Pembeli:
                                <?php echo htmlspecialchars(explode(' - ', $order['buyer_section_title'])[0]); ?>
                            </div>
                            <div class="detail-line"><?php echo htmlspecialchars($order['item_description']); ?></div>
                            <div class="detail-line">Total: <?php echo htmlspecialchars($order['item_price_per_unit']); ?>
                            </div>
                            <div class="detail-line">Tanggal: <?php echo htmlspecialchars($order['date']); ?></div>
                            <div class="detail-line">Status Uang: <?php echo htmlspecialchars($order['money_status']); ?>
                            </div>
                            <div class="detail-line">Status Barang: <?php echo htmlspecialchars($order['item_status']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="grand-total-section">
                        Total: <?php echo htmlspecialchars($order['grand_total_display']); ?>
                        <?php if ($order['action_button']): ?>
                            <button class="action-button"><?php echo htmlspecialchars($order['action_button']); ?></button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="footer-info">
                Menampilkan hasil: <?php echo $displayed_results; ?> dari <?php echo $total_results; ?>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php include 'footer.php'; ?>