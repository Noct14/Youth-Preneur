<div>
    <header class="header-bar-second">
        <div class="logo-container">
            <img src="{{ asset('images/uec.png') }}" alt="Ukridda E-Commerce Logo">
        </div>
        <div class="search-bar-wrapper">
            <form action="search" method="GET" class="search-bar">
                <input type="text" name="q" id="searchInput" placeholder="Cari di Sini" value="{{ request('q') }}">
                <button type="button" class="clear-btn" onclick="clearSearch()">✖</button>
            </form>
        </div>
        <a href="logout.php" class="logout-btn">Logout</a>
    </header>
    <div class="navbar-top-first">
        <a href="{{ route('seller') }}">Home</a>
        <a href="{{ route('seller') }}">Daftar Produk</a>
        <a href="pesanan_dikirim_disortir.php">Pesanan Dikirim</a>
        <a href="pesanan_masuk.php">Pesanan Masuk</a>
        <a href="proses_pesanan.php">Proses Pesanan</a>
    </div>

    <script>
        function clearSearch() {
            document.getElementById('searchInput').value = '';
            document.getElementById('searchInput').focus();
        }
    </script>

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
            min-height: 100vh;
            /* Ensures body takes full height */
            display: flex;
            /* Use flexbox for layout */
            flex-direction: column;
            /* Stack children vertically */
        }

        /* --- Bagian Navigasi Paling Atas (Full Width) --- */
        .navbar-top-first {
            display: flex;
            background-color: #fff;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            justify-content: center;
            /* Centers content within the full width */
            flex-wrap: wrap;
            gap: 25px;
            border-bottom: 1px solid #eee;
            width: 100%;
            /* Spans full width of the body */
            box-sizing: border-box;
            /* Include padding in width */
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

        /* --- Bagian Header Bar Kedua (Full Width) --- */
        .header-bar-second {
            background-color: #fff;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 999;
            width: 100%;
            /* Spans full width of the body */
            box-sizing: border-box;
            /* Include padding in width */
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
            /* Still constrain search bar width within the full-width header */
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

        /* --- Global Page Wrapper to control content width below header/navbar --- */
        #page-wrapper {
            max-width: 1200px;
            /* Desired overall content width for dashboard */
            margin: 20px auto 0 auto;
            /* Center the wrapper, add top margin */
            width: 100%;
            /* Ensure it takes full width on smaller screens up to max-width */
            flex-grow: 1;
            /* Allow it to grow and fill available space between header and footer */
            background-color: #f0f2f5;
            /* Match body background */
            padding: 0 20px;
            /* Add horizontal padding inside the wrapper */
            box-sizing: border-box;
            /* Include padding in width */
        }


        /* --- Konten Utama Dashboard (inside #page-wrapper) --- */
        .dashboard-main-content {
            padding: 0;
            /* Padding is now on #page-wrapper */
            width: 100%;
            /* Takes full width of its parent (#page-wrapper) */
            box-sizing: border-box;
            /* Include padding in width */
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

        /* --- GRID STATISTIK --- */
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

        /* --- Bagian Pesanan Masuk (example for structure) --- */
        .incoming-orders-section {
            margin-top: 30px;
            padding: 0;
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

            /* Adjustments for full-width sections on small screens */
            .navbar-top-first,
            .header-bar-second {
                padding-left: 15px;
                /* Add horizontal padding to full-width sections */
                padding-right: 15px;
            }

            .navbar-top-first {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }

            .navbar-top-first a {
                margin-right: 0;
            }

            .header-bar-second {
                flex-direction: column;
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

            /* Adjustments for the page-wrapper and its content on smaller screens */
            #page-wrapper {
                margin-top: 15px;
                /* Adjust top margin for smaller screens */
                padding: 0 15px;
                /* Adjust horizontal padding directly to the wrapper */
            }

            .dashboard-header-section {
                padding: 15px 20px;
                /* Internal padding for this section remains */
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
        }
    </style>
</div>
