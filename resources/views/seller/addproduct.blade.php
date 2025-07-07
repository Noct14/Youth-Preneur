<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ukrida E-Commerce Seller Dashboard - Tambah Produk</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/cropperjs@1.5.13/dist/cropper.min.css" rel="stylesheet" />
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

@include('components.seller.navbar')
<script src="https://unpkg.com/cropperjs@1.5.13/dist/cropper.min.js"></script>
<body>
    <div class="product-form-container">
        <div class="card-style-form">
            <div class="product-form-header">
                <h2>Tambah Produk</h2>
            </div>

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Image Upload + Crop --}}
                <div class="form-group">
                    <label for="imageInput">Upload Gambar</label><br>
                    <input type="file" id="imageInput" accept="image/*">
                    <div style="margin-top: 10px;">
                        <img id="imagePreview" style="max-width: 100%; display:none;" />
                    </div>
                    <button type="button" id="cropButton" class="btn btn-secondary mt-2">Crop & Simpan</button>
                </div>

                {{-- Preview hasil crop --}}
                <div class="form-group mt-3">
                    <label>Preview Gambar Akhir</label><br>
                    <img id="preview_0" src="#" style="max-width: 100%; display:none;" />
                    <input type="file" name="image" id="imageHidden" style="display:none;" required>
                </div>


                {{-- Nama Produk --}}
                <div class="form-group">
                    <label for="product_name">Nama Produk</label>
                    <input type="text" name="product_name" id="product_name" class="form-control" required>
                </div>

                {{-- Harga --}}
                <div class="form-group">
                    <label for="price">Harga</label>
                    <input type="number" name="price" id="price" class="form-control" required>
                </div>

                {{-- Kategori --}}
                <div class="form-group">
                    <label for="category">Kategori</label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Stok --}}
                <div class="form-group">
                    <label for="stock">Stok</label>
                    <input type="number" name="stock" id="stock" class="form-control" required>
                </div>

                {{-- Deskripsi --}}
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea name="description" id="description" rows="4" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Produk</button>
            </form>


        </div>

    </div>

    <script>
        let cropper;
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');
        const imageHidden = document.getElementById('imageHidden');

        imageInput.addEventListener('change', function (e) {
            const file = e.target.files[0];
            const reader = new FileReader();

            reader.onload = function (event) {
                imagePreview.src = event.target.result;
                imagePreview.style.display = 'block';

                imagePreview.onload = () => {
                    if (cropper) cropper.destroy();
                    cropper = new Cropper(imagePreview, {
                        aspectRatio: 4/3,
                        viewMode: 1,
                    });
                };
            };

            reader.readAsDataURL(file);
        });

        document.getElementById('cropButton').addEventListener('click', () => {
            const canvas = cropper.getCroppedCanvas({
                width: 800,
                height: 600,
            });

            canvas.toBlob((blob) => {
                if (!blob) {
                    alert("Gagal crop gambar.");
                    return;
                }

                // Simulasi input file
                const file = new File([blob], 'cropped.png', { type: 'image/png' });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                imageHidden.files = dataTransfer.files;

                // preview
                const preview = document.getElementById('preview_0');
                preview.src = URL.createObjectURL(blob);
                preview.style.display = 'block';

                alert('Gambar berhasil dicrop! Klik Simpan Produk untuk menyimpan.');
            }, 'image/png');
        });
    </script>


</body>

@include('components.seller.footer')
