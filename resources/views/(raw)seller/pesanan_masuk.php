<?php
// --- Bagian PHP: Variabel Dashboard & Data Pesanan ---

// Variabel untuk tampilan dashboard (dari kode Anda sebelumnya)
$ordersReceived = 10;
$ordersInProcess = 5;
$ordersShipped = 2;
$productCount = 2;
$uecBalance = 400000;
$receivedBalance = 200000;

// Data pesanan (disesuaikan dengan kunci yang digunakan di HTML loop Anda)
$orders = [
    [
        'id' => 'UEC0101',
        'product' => 'Boba Melekat Kayak Kamu',
        'customer' => 'Andreas',
        'customer_id' => '412022002',
        'items' => [
            ['name' => 'Jelly, Small', 'qty' => 4, 'price' => 10000],
            ['name' => 'Jelly Susu, Large', 'qty' => 1, 'price' => 15000],
        ],
        'total' => 55000,
        'date' => '01-04-2025',
    ],
    [
        'id' => 'UEC0102',
        'product' => 'Boba Melekat Kayak Kamu',
        'customer' => 'Hendi',
        'customer_id' => '', // Empty buyer ID
        'items' => [
            ['name' => 'Jelly, Large', 'qty' => 1, 'price' => 15000],
        ],
        'total' => 15000,
        'date' => '01-04-2025',
    ],
    [
        'id' => 'UEC0103',
        'product' => 'Yoghurt Strawberry',
        'customer' => 'Andreas',
        'customer_id' => '412022002',
        'items' => [
            ['name' => 'Small', 'qty' => 1, 'price' => 5000],
        ],
        'total' => 5000,
        'date' => '01-04-2025',
    ],
];

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

        /* Mengatur dasar body untuk flexbox layout */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
            color: #333;
            line-height: 1.6;
            display: flex;
            /* Menggunakan flexbox untuk layout vertikal */
            flex-direction: column;
            /* Menumpuk elemen secara vertikal */
            min-height: 100vh;
            /* Memastikan body memenuhi tinggi viewport minimum */
        }

        /* --- Bagian Navigasi Paling Atas --- */
        .navbar-top-first {
            display: flex;
            background-color: #fff;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            justify-content: center;
            flex-wrap: wrap;
            gap: 25px;
            border-bottom: 1px solid #eee;
            width: 100%;
            /* Memastikan lebar penuh */
        }

        .navbar-top-first a {
            text-decoration: none;
            color: #333;
            padding: 8px 0;
            font-size: 15px;
            font-weight: 500;
            white-space: nowrap;
        }

        .navbar-top-first a:hover {
            color: #007bff;
        }

        /* --- Bagian Header Bar Kedua --- */
        .header-bar-second {
            background-color: #fff;
            padding: 0;
            /* Padding dipindahkan ke .header-inner-container */
            display: flex;
            /* Tetap flex untuk menampung inner container */
            align-items: center;
            justify-content: center;
            /* Pusat inner container */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            /* Memastikan lebar penuh */
            z-index: 999;
        }

        /* Kontainer baru untuk membatasi lebar konten di dalam header */
        .header-bar-second .header-inner-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            /* Menjaga spasi antara elemen di dalam inner container */
            /* Cocokkan dengan max-width konten utama */
            width: 100%;
            /* Memastikan kontainer mengisi lebar yang tersedia */
            margin: 0 auto;
            /* Memusatkan kontainer */
            padding: 10px 20px;
            /* Padding di dalam kontainer, sama dengan padding header sebelumnya */
            box-sizing: border-box;
            /* Memasukkan padding dalam perhitungan lebar */
        }

        .header-bar-second .logo-container {
            display: flex;
            align-items: center;
            flex-shrink: 0;
            margin-right: 20px;
        }

        .header-bar-second .logo-container img {
            height: 75px;
            width: auto;
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
        }

        .header-bar-second .logout-btn:hover {
            background-color: #555;
        }

        /* --- Konten Utama Dashboard --- */
        .dashboard-main-content {
            padding: 20px;
            max-width: 1200px;
            /* Lebar maksimal sesuai keinginan */
            margin: 20px auto;
            /* Memusatkan konten di tengah halaman */
            background-color: #f0f2f5;
            flex-grow: 1;
            /* Penting: Membuat konten utama mengisi ruang yang tersedia,
                             mendorong footer ke bawah */
            width: 100%;
            /* Memastikan konten mengisi lebar yang tersedia di dalam max-width */
            box-sizing: border-box;
            /* Memasukkan padding dalam perhitungan lebar */
        }

        /* --- Bagian Header Dashboard --- */
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

        /* --- GRID STATISTIK (jika ada, tidak di halaman ini tapi dipertahankan gayanya) --- */
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

        /* --- Bagian Pesanan Masuk (Order Cards) --- */
        .orders-list-container {
            margin-top: 0;
            /* Jarak sudah diatur oleh margin-bottom dashboard-header-section */
            padding: 0;
        }

        /* Menggunakan .order-card sebagai kontainer utama untuk setiap item pesanan */
        .order-card {
            background-color: #fff;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: flex-start;
            /* Mengatur item agar sejajar di bagian atas */
        }

        .order-card:last-child {
            margin-bottom: 0;
            /* Tidak ada margin untuk kartu terakhir */
        }

        .order-card .product-image-placeholder {
            width: 100px;
            height: 100px;
            background-color: #e0e0e0;
            margin-right: 20px;
            border-radius: 4px;
            flex-shrink: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .order-card .product-image-placeholder svg {
            width: 60px;
            height: 60px;
            fill: #ccc;
        }

        .order-card .order-details {
            flex-grow: 1;
            /* Mengambil sisa ruang yang tersedia */
        }

        .order-card .order-details h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 18px;
            color: #333;
        }

        .order-card .order-details p {
            margin: 5px 0;
            font-size: 14px;
            color: #555;
        }

        .order-card .order-details .total-price {
            font-weight: bold;
            color: #333;
            margin-top: 10px;
        }

        .order-card .order-actions {
            display: flex;
            flex-direction: column;
            /* Tombol ditumpuk secara vertikal */
            gap: 10px;
            /* Jarak antar tombol */
            margin-top: 0;
            flex-shrink: 0;
            margin-left: 15px;
            width: 150px;
            /* Lebar tetap untuk kolom tombol */
        }

        .order-card .order-actions .action-btn {
            /* Gaya umum untuk kedua tombol */
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.2s ease;
            text-align: center;
        }

        .order-card .order-actions .process-btn {
            background-color: #007bff;
            /* Biru primer untuk proses */
            color: white;
        }

        .order-card .order-actions .process-btn:hover {
            background-color: #0056b3;
        }

        .order-card .order-actions .reject-btn {
            background-color: #6c757d;
            /* Abu-abu untuk tolak */
            color: white;
        }

        .order-card .order-actions .reject-btn:hover {
            background-color: #5a6268;
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

            .header-bar-second .header-inner-container {
                padding: 10px 15px;
                /* Sesuaikan padding untuk layar tablet */
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
                /* Padding dipindahkan ke inner container, jadi atur 0 di sini */
                padding: 0;
            }

            .header-bar-second .header-inner-container {
                flex-direction: column;
                /* Tumpuk item secara vertikal di mobile */
                padding: 15px;
                /* Atur padding yang sesuai untuk mobile */
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
                /* Sesuaikan kartu pesanan untuk layar kecil */
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .order-card .product-image-placeholder {
                margin-right: 0;
                margin-bottom: 15px;
            }

            .order-card .order-details {
                margin-bottom: 15px;
                /* Tambahkan ruang antara detail dan tombol */
            }

            .order-card .order-actions {
                flex-direction: row;
                /* Tombol bersebelahan di layar kecil */
                justify-content: center;
                margin-left: 0;
                width: 100%;
                /* Membuat tombol mengisi lebar penuh */
                gap: 10px;
                /* Jarak antara tombol horizontal */
            }

            .order-card .order-actions .action-btn {
                width: auto;
                flex-grow: 1;
                /* Memungkinkan tombol untuk tumbuh dan mengisi ruang */
            }
        }
    </style>
</head>

<body>
    <header class="header-bar-second">
        <div class="header-inner-container">
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
        </div>
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

    <div class="dashboard-main-content">
        <div class="dashboard-header-section">
            <h2>Pesanan Masuk</h2>
        </div>

        <div class="orders-list-container">
            <?php foreach ($orders as $order): ?>
                <div class="order-card">
                    <div class="product-image-placeholder">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="#ccc">
                            <path
                                d="M4 5h16v14H4zm1 1h14v12H5zm7 2.5a4.5 4.5 0 1 0 0 9 4.5 4.5 0 0 0 0-9m0 1a3.5 3.5 0 1 1 0 7 3.5 3.5 0 0 1 0-7M9 13.5a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7m-4 1a.5.5 0 0 0 0-1 .5.5 0 0 0 0 1m-.5 0a.5.5 0 0 0 0-1 .5.5 0 0 0 0 1zm0 0a.5.5 0 0 0 0-1 .5.5 0 0 0 0 1zM20 13.5a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7zM20 13.5a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7z" />
                        </svg>
                    </div>
                    <div class="order-details">
                        <h3><?php echo htmlspecialchars($order['product']); ?>
                            #<?php echo htmlspecialchars($order['id']); ?></h3>
                        <p>Pembeli: <?php echo htmlspecialchars($order['customer']); ?>
                            <?php echo !empty($order['customer_id']) ? '- ' . htmlspecialchars($order['customer_id']) : ''; ?>
                        </p>
                        <?php foreach ($order['items'] as $item): ?>
                            <p><?php echo htmlspecialchars($item['name']); ?>
                                (<?php echo htmlspecialchars($item['qty']); ?>&times;
                                <?php echo number_format($item['price'], 0, ',', '.'); ?>)
                            </p>
                        <?php endforeach; ?>
                        <p class="total-price">Total: <?php echo number_format($order['total'], 0, ',', '.'); ?></p>
                        <p>Tanggal: <?php echo htmlspecialchars($order['date']); ?></p>
                    </div>
                    <div class="order-actions">
                        <button class="action-btn process-btn">Proses Pesanan</button>
                        <button class="action-btn reject-btn">Tolak</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include 'footer.php'; ?>

</body>

</html>