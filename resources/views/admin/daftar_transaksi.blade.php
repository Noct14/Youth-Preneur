<head>
    <meta charset="utf-8">
    <title>Transaksi</title>
<style>
    body {
        font-family: sans-serif;
        background-color: #ffffff;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .main-content-wrapper {
        background-color: #ffffff;
        padding: 60px;
        margin: 0;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        border-radius: 0;
        box-sizing: border-box;
        width: 100%;
    }

    /* Header 'Daftar Transaksi' utama */
    .page-main-header {
        font-weight: bold;
        font-size: 0.8em; /* Sama dengan keranjang */
        padding-bottom: 30px;
        margin-bottom: 30px;
        border-bottom: 1px solid #eee;
    }

    /* Modifikasi .shop-section menjadi .transaction-entry untuk setiap entri transaksi */
    .transaction-entry {
        margin-bottom: 40px; /* Sama dengan keranjang */
        padding-bottom: 40px; /* Sama dengan keranjang */
        border-bottom: 1px solid #eee; /* Sama dengan keranjang */
    }

    .transaction-item-detail {
        display: flex;
        align-items: flex-start; /* Align items to the top */
        padding: 0;
        width: 100%;
        box-sizing: border-box;
    }

    .item-placeholder {
        width: 100px; /* DIKECILKAN: Menyamakan dengan keranjang */
        height: 100px; /* DIKECILKAN: Menyamakan dengan keranjang */
        background-color: #f0f0f0;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 20px; /* DIKECILKAN: Menyamakan dengan keranjang */
        border-radius: 4px;
        flex-shrink: 0;
        margin-bottom: 15px; /* Sama dengan keranjang */
    }
    .item-placeholder img {
        width: 70%;
        height: 70%;
        opacity: 0.5;
    }

    .transaction-info-group {
        flex-grow: 1;
    }

    .transaction-title {
        font-weight: bold;
        font-size: 1.2em; /* DIKECILKAN: Menyamakan dengan .item-name di keranjang */
        margin-bottom: 8px; /* DIKECILKAN: Menyamakan dengan keranjang */
    }

    .transaction-line-item {
        font-size: 0.9em; /* DIKECILKAN: Menyamakan dengan .item-info di keranjang */
        color: #555; /* Disesuaikan agar mirip .item-info di keranjang */
        margin-bottom: 5px; /* DIKECILKAN: Menyamakan dengan keranjang */
    }

    .transaction-total {
        font-weight: bold;
        font-size: 1.1em; /* DIKECILKAN: Sedikit lebih kecil dari .item-name tapi lebih besar dari .item-info, agar menonjol sebagai total */
        margin-top: 15px; /* DIKECILKAN: Menyamakan dengan .item-actions di keranjang */
        margin-bottom: 10px; /* DIKECILKAN: Disesuaikan */
    }

    .transaction-date {
        font-size: 0.9em; /* DIKECILKAN: Menyamakan dengan .item-info di keranjang */
        color: #555; /* Disesuaikan agar mirip .item-info di keranjang */
        margin-bottom: 15px; /* DIKECILKAN: Disesuaikan */
    }

    .transaction-status-action {
        display: flex;
        align-items: center;
        gap: 10px; /* DIKECILKAN: Menyamakan dengan .item-actions di keranjang */
        margin-top: 15px; /* DIKECILKAN: Menyamakan dengan .item-actions di keranjang */
    }

    .status-text {
        font-size: 0.9em; /* DIKECILKAN: Menyamakan dengan .item-info di keranjang */
        font-weight: 600;
        color: #333;
    }

    .komplain-button {
        padding: 8px 20px; /* DIKECILKAN: Menyamakan dengan tombol di keranjang */
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f8f8f8;
        cursor: pointer;
        font-size: 0.9em; /* DIKECILKAN: Menyamakan dengan tombol di keranjang */
        font-weight: normal;
        transition: background-color 0.2s ease-in-out;
    }
    .komplain-button:hover {
        background-color: #e0e0e0;
    }

    /* Footer checkout disembunyikan total (tetap sama) */
    .footer-checkout {
        display: none;
    }
    .checkout-button {
        display: none;
    }

    /* Dropdown Waktu */
    .filter-wrapper {
        margin-bottom: 30px;
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        align-items: center;
    }

    .filter-wrapper label {
        font-weight: bold;
        font-size: 0.9em;
    }

    .filter-wrapper select,
    .filter-wrapper input[type="date"] {
        padding: 8px 12px;
        font-size: 0.9em;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .filter-wrapper button {
        padding: 8px 20px;
        border: none;
        border-radius: 5px;
        background-color: #333;
        color: #fff;
        cursor: pointer;
        font-size: 0.9em;
        transition: background-color 0.2s ease-in-out;
    }

    .filter-wrapper button:hover {
        background-color: #555;
    }

    /* Perbaikan layout transaksi */
    .transaction-entry {
        border: 1px solid #eee;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 30px;
        background-color: #fafafa;
        transition: box-shadow 0.3s;
    }

    .transaction-entry:hover {
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .transaction-title {
        color: #333;
        font-size: 1.2em;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .transaction-line-item {
        margin-bottom: 3px;
    }

    .transaction-total {
        color: #000;
        font-size: 1.1em;
        margin-top: 10px;
        margin-bottom: 5px;
    }

    .transaction-date {
        font-size: 0.9em;
        color: #888;
    }

    .komplain-button {
        background-color: #f0f0f0;
        color: #333;
        border: 1px solid #ccc;
    }

    .komplain-button:hover {
        background-color: #ddd;
    }


    /* Responsive adjustments */
    @media (max-width: 768px) {
        .main-content-wrapper {
            padding: 20px;
        }
        .page-main-header {
            padding-bottom: 15px;
            margin-bottom: 15px;
        }
        .transaction-entry {
            margin-bottom: 20px;
            padding-bottom: 20px;
        }
        .transaction-item-detail {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .item-placeholder {
            width: 80px; /* DIKECILKAN: Sama dengan keranjang mobile */
            height: 80px; /* DIKECILKAN: Sama dengan keranjang mobile */
            margin-right: 0;
            margin-bottom: 10px; /* DIKECILKAN: Sama dengan keranjang mobile */
        }
        .transaction-title {
            font-size: 1.2em; /* Sama dengan keranjang mobile */
            margin-bottom: 10px;
        }
        .transaction-line-item,
        .transaction-total,
        .transaction-date,
        .status-text {
            font-size: 0.85em; /* DIKECILKAN: Sama dengan keranjang mobile */
        }
        .komplain-button {
            padding: 8px 15px; /* DIKECILKAN: Sama dengan keranjang mobile */
            font-size: 0.85em; /* DIKECILKAN: Sama dengan keranjang mobile */
        }
        .transaction-status-action {
            flex-direction: column;
            gap: 8px; /* DIKECILKAN: Sama dengan keranjang mobile */
            margin-top: 15px;
        }
    }
</style>
</head>
<body>
    @include('components.admin.navbar')
    <div class="main-content-wrapper">
        <div class="filter-wrapper">
            <input type="date" id="filter-date" name="filter-date" placeholder="Tanggal">
            
            <select id="filter-month" name="filter-month">
                <option value="">Pilih Bulan</option>
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
            
            <select id="filter-year" name="filter-year">
                <option value="">Pilih Tahun</option>
                <option value="2025">2025</option>
                <option value="2024">2024</option>
                <option value="2023">2023</option>
            </select>
            
            <button id="apply-filter">Terapkan</button>
        </div>

        <div class="transaction-entry">
            <div class="transaction-item-detail">
                <div class="item-placeholder">
                    <img src="data:image/svg+xml;base64,PHN2ZyB..." alt="Placeholder Image">
                </div>
                <div class="transaction-info-group">
                    <div class="transaction-title">Boba Melekat Kayak Kamu #UEC0101</div>
                    <div class="transaction-line-item">Jelly, Small - (4× 10.000)</div>
                    <div class="transaction-line-item">Jelly Susu, Large - (1× 15.000)</div>
                    <div class="transaction-total">Total: 55.000</div>
                    <div class="transaction-date">Tanggal: 01-04-2025</div>
                    <div class="transaction-status-action">
                        <span class="status-text">Pesanan Diambil</span>
                        <button class="komplain-button">Ajukan Komplain</button>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</body>
@include('components.admin.footer')
</html>

