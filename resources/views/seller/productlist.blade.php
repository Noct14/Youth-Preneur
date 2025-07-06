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

        /* Styles for "Daftar Produk" section */
        .section-header {
            background-color: #e0e0e0;
            /* Matches the top header in the product image */
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ccc;
            font-size: 24px;
            /* Adjust font size to match product image */
            color: #333;
            font-weight: 600;
            border-radius: 4px 4px 0 0;
            /* Rounded top corners if section is a separate box */
            margin-top: 20px;
            margin-bottom: 20px;
            /* Space from previous section */
        }

        .section-header button {
            font-size: 30px;
            color: #555;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            line-height: 1;
            /* Aligns the '+' correctly */
        }

        .product-list {
            list-style: none;
            /* Remove bullet points */
            padding: 0;
            margin: 0;
        }

        .product-item {
            background-color: #fff;
            border-radius: 0;
            /* No rounded corners for list items within a section, adjust if section is not a full box */
            padding: 15px;
            margin-bottom: 10px;
            /* Smaller gap between items */
            display: flex;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border: 1px solid #eee;
            /* Light border between items */
            border-top: none;
            /* No top border for items after the first */
        }

        .product-item:first-of-type {
            border-top: 1px solid #eee;
            /* Add top border for the first item if needed */
        }

        .product-image {
            width: 80px;
            height: 80px;
            background-color: #e0e0e0;
            border-radius: 4px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 15px;
            color: #aaa;
            flex-shrink: 0;
        }

        .product-image svg {
            fill: #bbb;
            /* Make SVG color consistent with the placeholder background */
            width: 48px;
            /* Adjust SVG size */
            height: 48px;
        }

        .product-info {
            flex-grow: 1;
        }

        .product-title {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 5px;
            color: #333;
        }

        .actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .actions .edit-text {
            text-decoration: none;
            color: #337ab7;
            border: 1px solid #ccc;
            padding: 8px 12px;
            border-radius: 4px;
            background-color: #f0f0f0;
            cursor: pointer;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s ease;
        }

        .actions .edit-text:hover {
            background-color: #e0e0e0;
        }

        .actions .btn-tandai {
            background-color: #f0f0f0;
            color: #333;
            border: 1px solid #ccc;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.2s ease;
        }

        .actions .btn-tandai:hover {
            background-color: #e0e0e0;
        }

        .actions .btn-delete {
            background-color: #ffe0e0;
            border: 1px solid #e74c3c;
            color: #e74c3c;
            padding: 6px 10px;
            /* Smaller padding for icon button */
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s ease;
        }

        .actions .btn-delete:hover {
            background-color: #ffcaca;
        }

        .actions .btn-delete svg {
            width: 20px;
            /* Size of trash icon */
            height: 20px;
        }

        .add-button {
            text-decoration: none;
        }

        /* Ensure the main content has max-width and margin for centering */
        main {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
            /* Add some padding on smaller screens */
        }

        section {
            background-color: #fff;
            /* White background for the entire section */
            border-radius: 8px;
            /* Overall rounded corners for the product list section */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            overflow: hidden;
            /* Ensures rounded corners are applied correctly */
        }

        .container-body {
            padding: 1.25em 5em;
            background-color:
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

            /* Product list responsive adjustments */
            .product-item {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .product-image {
                margin-bottom: 15px;
                margin-right: 0;
            }

            .product-info {
                width: 100%;
            }

            .actions {
                flex-direction: row;
                justify-content: center;
                width: 100%;
                flex-wrap: wrap;
                /* Allow actions to wrap on small screens */
            }

            .actions .edit-text,
            .actions .btn-tandai,
            .actions .btn-delete {
                flex-grow: 1;
            }

            .container-body {
                padding: 1.25em
            }
        }
    </style>
</head>

@include('components.seller.navbar')

<div class="container-body">
    <div class="section-header">
            Daftar Produk
            <a href="tambah_produk.php" class="add-button" aria-label="Tambah Produk">+</a>
        </div>
        <ul class="product-list">
                <li class="product-item">
                <div class="product-image" aria-label="Placeholder image">
                <svg width="48" height="48" fill="#bbb" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"></svg>
                </div>
                <div class="product-info">
                <h3 class="product-title">burger</h3>
                <div class="actions">
                <a href="edit_produk.php?id=' . $product['id'] . '" class="edit-text">Edit</a>
                <button class="btn-tandai" type="button">Tandai Habis</button>
                <button class="btn-delete" aria-label="Hapus Produk">
                <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" width="48px" height="48px">
                    <path d="M 10 2 L 9 3 L 5 3 C 4.4 3 4 3.4 4 4 C 4 4.6 4.4 5 5 5 L 7 5 L 17 5 L 19 5 C 19.6 5 20 4.6 20 4 C 20 3.4 19.6 3 19 3 L 15 3 L 14 2 L 10 2 z M 5 7 L 5 20 C 5 21.1 5.9 22 7 22 L 17 22 C 18.1 22 19 21.1 19 20 L 19 7 L 5 7 z M 9 9 C 9.6 9 10 9.4 10 10 L 10 19 C 10 19.6 9.6 20 9 20 C 8.4 20 8 19.6 8 19 L 8 10 C 8 9.4 8.4 9 9 9 z M 15 9 C 15.6 9 16 9.4 16 10 L 16 19 C 16 19.6 15.6 20 15 20 C 14.4 20 14 19.6 14 19 L 14 10 C 14 9.4 14.4 9 15 9 z"></path>
                </svg>
                </button>
                </div>
                </div>
                </li>

        </ul>
    </div>

@include('components.seller.footer')
