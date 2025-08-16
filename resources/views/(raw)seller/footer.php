<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Footer UEC</title>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        footer {
            background-color: #f1f1f1;
            /* Warna background footer */
            padding: 40px 60px;
            /* Padding lebih besar untuk konten */
            font-size: 14px;
            color: #555;
            margin-top: auto;
            /* Memastikan footer selalu di bawah */
            display: flex;
            /* Menggunakan Flexbox untuk layout kolom */
            justify-content: space-between;
            /* Menyebar item ke sisi */
            align-items: flex-start;
            /* Mengatur item dari atas */
            flex-wrap: wrap;
            /* Memungkinkan wrap di layar kecil */
        }

        .footer-section {
            flex: 1;
            /* Setiap section mengambil ruang yang sama secara default */
            min-width: 200px;
            /* Lebar minimum untuk setiap kolom agar tidak terlalu sempit */
            margin-right: 30px;
            /* Jarak antar kolom */
        }

        .footer-section:last-of-type {
            margin-right: 0;
            /* Hapus margin kanan untuk kolom terakhir */
        }

        .footer-section h4 {
            font-size: 1.1em;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
            /* Sesuai dengan gambar */
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-section ul li {
            margin-bottom: 10px;
        }

        .footer-section ul li a {
            text-decoration: none;
            color: #555;
            transition: color 0.2s ease;
        }

        .footer-section ul li a:hover {
            color: #000;
        }

        .footer-images {
            display: flex;
            gap: 15px;
            /* Jarak antar gambar */
            align-items: center;
            /* Pusatkan gambar secara vertikal */
            margin-left: auto;
            /* Dorong gambar ke kanan */
            flex-shrink: 0;
            /* Pastikan gambar tidak mengecil */
            padding-right: 0px;
            /* Tidak ada padding kanan tambahan */
            height: 120px;
            /* Diperbesar 3.5 kali lipat dari 100px */
        }

        /* Styling spesifik untuk gambar di footer */
        .footer-images img {
            height: 100%;
            /* Membuat tinggi gambar mengisi tinggi container .footer-images */
            width: auto;
            /* Disesuaikan untuk menampung gambar yang lebih tinggi */
            object-fit: contain;
            /* Memastikan gambar tidak terpotong dan mempertahankan rasio aspek */
            border-radius: 5px;
            /* Sedikit border-radius untuk gambar */
        }

        .footer-copyright {
            width: 100%;
            /* Menempati lebar penuh */
            text-align: center;
            margin-top: 30px;
            /* Jarak dari konten di atasnya */
            padding-top: 15px;
            border-top: 1px solid #e0e0e0;
            /* Garis pemisah di atas copyright */
            color: #777;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            footer {
                flex-direction: column;
                /* Kolom jadi stack di mobile */
                padding: 30px 20px;
                /* Kurangi padding */
                align-items: center;
                /* Pusatkan item */
            }

            .footer-section {
                margin-right: 0;
                margin-bottom: 30px;
                /* Jarak antar section di mobile */
                text-align: center;
                width: 100%;
                /* Ambil lebar penuh */
                min-width: unset;
                /* Hapus min-width */
            }

            .footer-images {
                margin-left: 0;
                /* Hapus margin auto di mobile */
                justify-content: center;
                /* Pusatkan gambar di mobile */
                width: 100%;
                margin-bottom: 30px;
                /* Jarak gambar dari copyright jika di atasnya */
                height: auto;
                /* Di mobile, biarkan tinggi auto */
            }

            .footer-images img {
                height: 80px;
                /* Sesuaikan tinggi gambar di mobile agar tidak terlalu besar */
                max-width: 120px;
                /* Sesuaikan lebar maksimum di mobile */
            }

            .footer-copyright {
                margin-top: 20px;
            }
        }
    </style>
</head>

<body>
    <footer>
        <div class="footer-section">
            <h4>Kontak</h4>
            <ul>
                <li><a href="#">Pengurus UEC</a></li>
                <li><a href="#">Bergabung Menjadi Penjual</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h4>Profil Pengembang</h4>
            <ul>
                <li><a href="#">Tentang Pengembang</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h4>Tentang Ukrida E Commerce</h4>
            <ul>
                <li><a href="#">Profil</a></li>
            </ul>
        </div>

        <div class="footer-images">
            <img src="uec-edit.png" alt="Logo UEC">
            <img src="ukrida.png" alt="Logo Ukrida" style="max-width: 250px">
        </div>

        <div class="footer-copyright">
            2025 UEC
        </div>
    </footer>
</body>

</html>