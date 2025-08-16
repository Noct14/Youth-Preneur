<?php
// Angka yang diinginkan untuk tampilan dashboard (dari kode Anda sebelumnya)
$ordersReceived = 10;
$ordersInProcess = 5;
$ordersShipped = 2;
$productCount = 2;
$uecBalance = 400000;
$receivedBalance = 200000;

// Anda bisa menambahkan logika PHP untuk menangani pengiriman form "Tambah Produk" di sini
// Misalnya, jika form disubmit:
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_product'])) {
    $namaProduk = $_POST['nama_produk'];
    $keteranganProduk = $_POST['keterangan_produk'];

    // Contoh sederhana penanganan upload gambar
    // Anda perlu menambahkan validasi file, pemindahan file, dll.
    // Misalnya, untuk 3 gambar:
    // for ($i = 0; $i < 3; $i++) {
    //     if (isset($_FILES['gambar_produk_' . $i]) && $_FILES['gambar_produk_' . $i]['error'] == 0) {
    //         $target_dir = "uploads/"; // Pastikan folder ini ada dan writable
    //         $target_file = $target_dir . basename($_FILES['gambar_produk_' . $i]['name']);
    //         if (move_uploaded_file($_FILES['gambar_produk_' . $i]['tmp_name'], $target_file)) {
    //             echo "Gambar " . ($i+1) . " berhasil diupload.<br>";
    //         } else {
    //             echo "Gagal mengupload gambar " . ($i+1) . ".<br>";
    //         }
    //     }
    // }

    // Di sini Anda akan menyimpan $namaProduk, $keteranganProduk, dan informasi gambar ke database
    // echo "<p>Produk '$namaProduk' dengan keterangan '$keteranganProduk' berhasil ditambahkan (simulasi).</p>";
    // Redirect atau tampilkan pesan sukses
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ukrida E-Commerce Seller Dashboard - Tambah Produk</title>
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

        /* --- Bagian Navigasi Paling Atas --- */
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

        /* --- Bagian Header Bar Kedua --- */
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

        /* --- Konten Utama Dashboard & Form Tambah Produk --- */
        main {
            padding: 20px;
            max-width: 1200px;
            margin: 20px auto;
            background-color: #f0f2f5;
            /* Latar belakang untuk area konten utama */
        }

        main h1 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #333;
            font-weight: 700;
        }

        /* --- CSS untuk Bagian Tambah Produk (diambil dari jawaban sebelumnya) --- */
        .product-form-container {
            /* Ganti .container dari sebelumnya menjadi ini agar tidak konflik */
            width: 100%;
            padding: 1.25em 5em;
            /* Tengahkankan form di dalam main */
        }

        .card-style-form {
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        .product-form-header {
            /* Ganti .header dari sebelumnya menjadi ini */
            background-color: #e0e0e0;
            padding: 15px 30px;
            /* Menutupi padding container untuk header */
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .product-form-header h2 {
            /* Ubah h1 menjadi h2 agar tidak konflik dengan h1 utama */
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .image-placeholders {
            display: flex;
            justify-content: space-around;
            margin-bottom: 30px;
        }

        .image-placeholder {
            width: 100%;
            background-color: transparent;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #aaa;
            font-size: 60px;
            position: relative;
            /* Untuk penempatan input file */
            overflow: hidden;
            padding: 0.5em;
            /* Sembunyikan overflow input file */
        }

        .image-placeholder input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 10;
        }

        .image-placeholder img {
            /* Untuk menampilkan preview gambar */
            width: 100%;
            height: 100%;
            object-fit: contain;
            z-index: 5;
        }

        .image-placeholder svg {
            fill: #ccc;
            z-index: 1;
            /* Pastikan SVG di bawah gambar preview */
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .form-group input[type="text"]:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #888;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .upload-button-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 30px;
        }

        .upload-button {
            background-color: #333;
            /* Mengikuti gaya tombol logout */
            color: #fff;
            padding: 10px 25px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .upload-button:hover {
            background-color: #555;
        }

        /* --- Responsive adjustments --- */
        @media (max-width: 992px) {

            /* ... (CSS responsive yang sudah ada) ... */
            .navbar-top-first a {
                font-size: 14px;
            }

            .product-form-container {
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

            /* Penyesuaian untuk form produk di layar kecil */
            .image-placeholders {
                flex-direction: column;
                align-items: center;
                gap: 20px;
            }

            .image-placeholder {
                width: 100%;
                /* Lebar penuh pada layar kecil */
                max-width: 250px;
                /* Batasi lebar agar tidak terlalu besar */
                height: 150px;
            }

            .upload-button-container {
                justify-content: center;
                /* Tombol upload di tengah */
            }

            .product-form-container {
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

    <div class="product-form-container">
        <div class="card-style-form">
            <div class="product-form-header">
                <h2>Tambah Produk</h2>
            </div>

            <form action="#" method="post" enctype="multipart/form-data" style="padding: 1.25em">
                <div class="image-placeholders">
                    <div class="image-placeholder">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="image" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor"
                                d="M464 64H48C21.49 64 0 85.49 0 112v288c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V112c0-26.51-21.49-48-48-48zm-6 336H54c-3.31 0-6-2.69-6-6V118c0-3.31 2.69-6 6-6h404c3.31 0 6 2.69 6 6v276c0 3.31-2.69 6-6 6zM140.23 204.64l67.57 67.57c6.25 6.25 16.38 6.25 22.63 0l67.57-67.57c6.25-6.25 16.38-6.25 22.63 0L396 293.4V384H116l24.23-88.96c6.25-6.25 16.38-6.25 22.63 0zM192 176c-17.67 0-32 14.33-32 32s14.33 32 32 32 32-14.33 32-32-14.33-32-32-32z">
                            </path>
                        </svg>
                        <img id="preview_0" src="#" alt="Gambar Produk 1" style="display: none;">
                        <input type="file" name="gambar_produk_0" id="gambar_produk_0" accept="image/*"
                            onchange="previewImage(event, 'preview_0')">
                    </div>
                    <div class="image-placeholder">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="image" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor"
                                d="M464 64H48C21.49 64 0 85.49 0 112v288c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V112c0-26.51-21.49-48-48-48zm-6 336H54c-3.31 0-6-2.69-6-6V118c0-3.31 2.69-6 6-6h404c3.31 0 6 2.69 6 6v276c0 3.31-2.69 6-6 6zM140.23 204.64l67.57 67.57c6.25 6.25 16.38 6.25 22.63 0l67.57-67.57c6.25-6.25 16.38-6.25 22.63 0L396 293.4V384H116l24.23-88.96c6.25-6.25 16.38-6.25 22.63 0zM192 176c-17.67 0-32 14.33-32 32s14.33 32 32 32 32-14.33 32-32-14.33-32-32-32z">
                            </path>
                        </svg>
                        <img id="preview_1" src="#" alt="Gambar Produk 2" style="display: none;">
                        <input type="file" name="gambar_produk_1" id="gambar_produk_1" accept="image/*"
                            onchange="previewImage(event, 'preview_1')">
                    </div>
                    <div class="image-placeholder">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="image" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor"
                                d="M464 64H48C21.49 64 0 85.49 0 112v288c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V112c0-26.51-21.49-48-48-48zm-6 336H54c-3.31 0-6-2.69-6-6V118c0-3.31 2.69-6 6-6h404c3.31 0 6 2.69 6 6v276c0 3.31-2.69 6-6 6zM140.23 204.64l67.57 67.57c6.25 6.25 16.38 6.25 22.63 0l67.57-67.57c6.25-6.25 16.38-6.25 22.63 0L396 293.4V384H116l24.23-88.96c6.25-6.25 16.38-6.25 22.63 0zM192 176c-17.67 0-32 14.33-32 32s14.33 32 32 32 32-14.33 32-32-14.33-32-32-32z">
                            </path>
                        </svg>
                        <img id="preview_2" src="#" alt="Gambar Produk 3" style="display: none;">
                        <input type="file" name="gambar_produk_2" id="gambar_produk_2" accept="image/*"
                            onchange="previewImage(event, 'preview_2')">
                    </div>
                </div>

                <div class="form-group">
                    <label for="nama_produk">Nama Produk</label>
                    <input type="text" id="nama_produk" name="nama_produk" value="Boba Melekat Kayak Kamu"
                        placeholder="Masukkan nama produk">
                </div>

                <div class="form-group">
                    <label for="keterangan_produk">Keterangan Produk</label>
                    <textarea id="keterangan_produk" name="keterangan_produk" rows="3"
                        placeholder="Masukkan keterangan produk">Rasanya Enak</textarea>
                </div>

                <div class="upload-button-container">
                    <button type="submit" name="submit_product" class="upload-button">Upload</button>
                </div>
            </form>
        </div>

    </div>
    <?php include 'footer.php'; ?>

    <script>
        function previewImage(event, previewId) {
            const reader = new FileReader();
            reader.onload = function () {
                const output = document.getElementById(previewId);
                output.src = reader.result;
                output.style.display = 'block'; // Tampilkan gambar
                output.previousElementSibling.style.display = 'none'; // Sembunyikan SVG
            };
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            } else {
                // Jika file dihapus/tidak ada, tampilkan lagi SVG dan sembunyikan gambar
                const output = document.getElementById(previewId);
                output.src = '#';
                output.style.display = 'none';
                output.previousElementSibling.style.display = 'block';
            }
        }
    </script>

</body>

</html>