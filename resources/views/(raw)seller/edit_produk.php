<?php
// Angka yang diinginkan untuk tampilan
$ordersReceived = 10;
$ordersInProcess = 5;
$ordersShipped = 2;
$productCount = 2;
$uecBalance = 400000;
$receivedBalance = 200000;

// Data untuk Topping (dari kode Edit Produk sebelumnya)
$toppings = [
    ['name' => 'Jelly', 'price' => '5.000'],
    ['name' => 'Nata De Coco', 'price' => '6.000'],
    ['name' => 'Pudding', 'price' => '2.000'],
];

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ukrida E-Commerce Seller Dashboard - Edit Produk</title>
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
            display: flex;
            /* Use flexbox for body */
            flex-direction: column;
            /* Stack children vertically */
            min-height: 100vh;
            /* Ensure body takes full viewport height */
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
        /* This section was present in your original code but not explicitly used for edit_produk page layout.
           Keeping it for consistency if other dashboard pages use it. */
        .dashboard-main-content {
            padding: 20px;
            max-width: 1200px;
            margin: 20px auto;
            background-color: #f0f2f5;
            flex-grow: 1;
            /* Allow this to grow and take available space */
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

        /* --- Bagian Pesanan Masuk (image_7578b3.png & image_757fb8.png) --- */
        .incoming-orders-section {
            margin-top: 30px;
            padding: 0 0px;
        }

        .incoming-orders-section h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
            font-weight: 600;
            padding-left: 0;
        }

        .order-item {
            background-color: #fff;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: flex-start;
        }

        .order-item .product-image-placeholder {
            width: 80px;
            height: 80px;
            background-color: #e0e0e0;
            margin-right: 15px;
            border-radius: 5px;
            flex-shrink: 0;
        }

        .order-item .order-details {
            flex-grow: 1;
        }

        .order-item .order-details h4 {
            margin-top: 0;
            margin-bottom: 5px;
            color: #333;
            font-size: 16px;
            font-weight: 500;
        }

        .order-item .order-details p {
            margin: 0;
            font-size: 14px;
            color: #666;
        }

        .order-item .order-actions {
            display: flex;
            flex-direction: column;
            gap: 5px;
            margin-top: 0;
            flex-shrink: 0;
            margin-left: 15px;
        }

        .order-item .order-actions button {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.2s ease;
            width: 120px;
            text-align: center;
        }

        .order-item .order-actions .process-button {
            background-color: #333;
            color: #fff;
        }

        .order-item .order-actions .process-button:hover {
            background-color: #555;
        }

        .order-item .order-actions .reject-button {
            background-color: #6c757d;
            color: #fff;
        }

        .order-item .order-actions .reject-button:hover {
            background-color: #5a6268;
        }

        /* --- Styling for Edit Produk Section --- */
        .edit-product-container {
            width: 100%;
            /* Ensure it takes full available width */
            max-width: 800px;
            margin: 20px auto;
            /* Centered with top/bottom margin */
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 30px;
            box-sizing: border-box;
            /* Include padding in the element's total width and height */
            flex-grow: 1;
            /* Allow this container to grow and take available space */
        }

        .edit-product-container h1 {
            color: #333;
            margin-bottom: 30px;
        }

        .edit-product-section {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .edit-product-section-title {
            font-weight: bold;
            margin-bottom: 15px;
            color: #555;
        }

        .edit-product-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .edit-product-item:last-child {
            border-bottom: none;
        }

        .edit-product-item-name {
            font-weight: normal;
            color: #333;
        }

        .edit-product-item-price {
            color: #777;
            font-size: 0.9em;
            margin-left: 10px;
        }

        .edit-product-item-actions a {
            text-decoration: none;
            color: #007bff;
            margin-left: 15px;
        }

        .edit-product-item-actions a:hover {
            text-decoration: underline;
        }

        .edit-product-add-link {
            display: block;
            margin-top: 15px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        .edit-product-add-link:hover {
            text-decoration: underline;
        }

        .edit-product-placeholder-image {
            width: 150px;
            height: 150px;
            background-color: #e0e0e0;
            border-radius: 8px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #aaa;
            font-size: 5em;
            margin-right: 20px;
            flex-shrink: 0;
        }

        .edit-product-header {
            display: flex;
            align-items: flex-start;
            margin-bottom: 30px;
        }

        .edit-product-details {
            flex-grow: 1;
        }

        .edit-product-form-group {
            margin-bottom: 15px;
        }

        .edit-product-form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }

        .edit-product-form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .edit-product-button-group {
            margin-top: 30px;
            text-align: center;
        }

        .edit-product-button {
            display: block;
            width: 100%;
            padding: 12px 20px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            margin-bottom: 10px;
        }

        .edit-product-button:hover {
            background-color: #555;
        }

        .edit-product-button-secondary {
            background-color: #6c757d;
        }

        .edit-product-button-secondary:hover {
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

            .order-item {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .order-item .product-image-placeholder {
                margin-right: 0;
                margin-bottom: 15px;
            }

            .order-item .order-actions {
                flex-direction: row;
                justify-content: center;
                margin-left: 0;
                width: 100%;
            }

            .order-item .order-actions button {
                width: auto;
                flex-grow: 1;
            }

            /* Responsive for Edit Product section */
            .edit-product-header {
                flex-direction: column;
                align-items: center;
            }

            .edit-product-placeholder-image {
                margin-right: 0;
                margin-bottom: 20px;
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

    <div class="edit-product-container">
        <h1>Edit Produk</h1>

        <div class="edit-product-header">
            <div class="edit-product-placeholder-image">
                <p>🖼️</p>
            </div>
            <div class="edit-product-details">
            </div>
        </div>

        <div class="edit-product-section">
            <div class="edit-product-section-title">Topping</div>
            <?php
            foreach ($toppings as $topping) {
                echo '<div class="edit-product-item">';
                echo '<div>';
                echo '<span class="edit-product-item-name">' . htmlspecialchars($topping['name']) . '</span>';
                echo '<span class="edit-product-item-price">Rp. ' . htmlspecialchars($topping['price']) . '</span>';
                echo '</div>';
                echo '<div class="edit-product-item-actions">';
                echo '<a href="#">Edit</a>';
                echo '<a href="#">Hapus</a>';
                echo '</div>';
                echo '</div>';
            }
            ?>
            <a href="#" class="edit-product-add-link">Tambahkan Lainnya di Menu Ini</a>
        </div>

        <div class="edit-product-section">
            <div class="edit-product-section-title">Ukuran</div>
            <div class="edit-product-item">
                <div>
                    <span class="edit-product-item-name">Small</span>
                </div>
                <div class="edit-product-item-actions">
                </div>
            </div>
            <a href="#" class="edit-product-add-link">Tambahkan Ukuran Lainnya</a>
        </div>

        <div class="edit-product-section">
            <div class="edit-product-section-title">Tambahkan Judul Variasi</div>
            <div class="edit-product-form-group">
                <input type="text" class="edit-product-form-control" value="Nama Variasi" readonly>
            </div>
            <div class="edit-product-item">
                <div>
                    <span class="edit-product-item-name">Nama Variasi</span>
                    <span class="edit-product-item-price">Atur Harga</span>
                </div>
                <div class="edit-product-item-actions">
                    <a href="#">Edit</a>
                    <a href="#">Hapus</a>
                </div>
            </div>
            <a href="#" class="edit-product-add-link">Tambahkan Jenis Variasi Lainnya<br>di Menu Ini</a>
        </div>

        <div class="edit-product-button-group">
            <a href="#" class="edit-product-button">Edit Gambar, Judul Dan Keterangan</a>
            <a href="#" class="edit-product-button edit-product-button-secondary">Tambah Menu Variasi</a>
        </div>

    </div>
</body>

</html>

<?php include 'footer.php'; ?>