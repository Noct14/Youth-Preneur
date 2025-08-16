<?php
// Angka yang diinginkan untuk tampilan
$ordersReceived = 10;
$ordersInProcess = 5;
$ordersShipped = 2;
$productCount = 2;
$uecBalance = 400000;
$receivedBalance = 200000;

// Contoh data pesanan (from the first response)
$orders = [
    [
        'order_id' => '#UEC0105',
        'product_name' => 'Boba Melekat Kayak Kamu',
        'buyer_name' => 'Andreas',
        'buyer_id' => '412022002',
        'item_details' => 'Jelly, Medium - (4 × 12.000)',
        'total' => '12.000',
        'date' => '31-03-2025',
        'status' => 'Antar Pesanan'
    ],
    [
        'order_id' => '#UEC0106',
        'product_name' => 'Boba Melekat Kayak Kamu',
        'buyer_name' => 'Hendi',
        'buyer_id' => '', // Assuming this can be empty based on image
        'item_details' => 'Jelly, Large - (1 × 15.000)',
        'total' => '15.000',
        'date' => '31-03-2025',
        'status' => 'Proses Pesanan'
    ]
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
        main {
            padding: 20px;
            max-width: 1200px;
            margin: 20px auto;
            background-color: #f0f2f5;
            /* Changed to match body background for seamless look */
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
        /* Changed from .incoming-orders-section to .order-list-container for clarity */
        .order-list-container {
            padding: 1.25em 5em;
            /* Removed padding to let .order-card manage its own spacing */
        }

        .order-list-container h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
            font-weight: 600;
            padding-left: 0;
        }

        .order-card {
            /* Reused from the first example, adjusted for integration */
            display: flex;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            width: 100%
        }

        .order-card-image {
            /* Renamed from .order-image for clarity */
            flex-shrink: 0;
            width: 100px;
            height: 100px;
            background-color: #e0e0e0;
            border-radius: 4px;
            margin-right: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #888;
            font-size: 14px;
            font-weight: bold;
            /* Added for the 'IMG' text */
        }

        .order-card-details {
            /* Renamed from .order-details for clarity */
            flex-grow: 1;
        }

        .order-card-details h3 {
            /* Changed from h4 for consistency with initial request's image text */
            margin-top: 0;
            margin-bottom: 5px;
            color: #333;
            font-size: 1.1em;
            /* Adjusted for better visual match */
            font-weight: 500;
        }

        .order-card-details p {
            /* Changed from generic p to specific for order details */
            margin: 3px 0;
            /* Adjusted margin */
            color: #555;
            font-size: 0.9em;
            /* Adjusted for better visual match */
        }

        .order-card-actions {
            /* Renamed from .order-actions for clarity */
            display: flex;
            gap: 10px;
            /* Adjusted gap */
            margin-top: 10px;
            /* Added top margin for separation */
        }

        .order-card-actions button {
            background-color: #007bff;
            /* Default button color */
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9em;
            transition: background-color 0.2s ease;
            width: auto;
            /* Allow buttons to size based on content */
        }

        .order-card-actions button:hover {
            background-color: #0056b3;
        }

        .order-card-actions .status-button {
            /* Specific style for "Proses Pesanan" */
            background-color: #28a745;
            /* Green */
            cursor: default;
            /* Not clickable as it's a status */
        }

        .order-card-actions .status-button:hover {
            background-color: #28a745;
            /* Keep same color on hover */
        }

        .order-card-actions .print-receipt-button {
            /* Style for "Cetak Resi" */
            background-color: #6c757d;
            /* Grey */
        }

        .order-card-actions .print-receipt-button:hover {
            background-color: #5a6268;
        }

        .container {
            padding: 1.25em 5em;
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

            .order-list-container {
                padding: 1.25em;
                /* Removed padding to let .order-card manage its own spacing */
            }

            .container {
                padding: 1.25em;
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

            /* The dashboard-header-section is not in the combined code, so its media query is removed for now */
            /* .dashboard-header-section {
                padding: 15px 20px;
            } */
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .stat-card {
                padding: 15px;
            }

            .order-card {
                /* Adjusted order-item to order-card for consistency */
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .order-card-image {
                /* Adjusted product-image-placeholder to order-card-image */
                margin-right: 0;
                margin-bottom: 15px;
            }

            .order-card-actions {
                /* Adjusted order-actions to order-card-actions */
                flex-direction: row;
                justify-content: center;
                margin-left: 0;
                width: 100%;
            }

            .order-card-actions button {
                width: auto;
                flex-grow: 1;
            }

            .order-list-container {
                padding: 1.25em;
                /* Removed padding to let .order-card manage its own spacing */
            }

            .container {
                padding: 1.25em;
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

    <div class="container">
        <div style="background-color: #fff;
            padding: 1.25em;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            border-radius: 8px;
            width: 100%;">
            <h2>Proses Pesanan</h2>
        </div>
    </div>

    <div class="order-list-container">
        <?php
        foreach ($orders as $order) {
            ?>
            <div class="order-card">
                <div class="order-card-image">
                    IMG
                </div>
                <div class="order-card-details">
                    <h3><?php echo htmlspecialchars($order['product_name'] . ' ' . $order['order_id']); ?></h3>
                    <p>Pembeli: <?php echo htmlspecialchars($order['buyer_name']); ?>
                        <?php echo !empty($order['buyer_id']) ? '- ' . htmlspecialchars($order['buyer_id']) : ''; ?>
                    </p>
                    <p><?php echo htmlspecialchars($order['item_details']); ?></p>
                    <p>Total: <?php echo htmlspecialchars($order['total']); ?></p>
                    <p>Tanggal: <?php echo htmlspecialchars($order['date']); ?></p>
                    <div class="order-card-actions">
                        <?php if ($order['status'] === 'Antar Pesanan') { ?>
                            <button><?php echo htmlspecialchars($order['status']); ?></button>
                        <?php } else { ?>
                            <button class="status-button"><?php echo htmlspecialchars($order['status']); ?></button>
                        <?php } ?>
                        <button class="print-receipt-button">Cetak Resi</button>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <?php include 'footer.php'; ?>

</body>

</html>