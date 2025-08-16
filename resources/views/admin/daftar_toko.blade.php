<head>
    <meta charset="utf-8">
    <title>Daftar Toko</title>
<style>
    .content {
        padding:48px;
        background-color: #f6f6f6;
    }

    .store-card {
        display: flex;
        padding: 20px;
        border-radius: 10px;
        background-color: #ffffff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
        border: 1px solid #ddd;
    }

    .store-image {
        width: 100px;
        height: 100px;
        background-color: #eee;
        border-radius: 8px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 20px;
        flex-shrink: 0;
    }

    .store-image img {
        width: 60%;
        opacity: 0.3;
    }

    .store-info {
        flex: 1;
    }

    .store-info h3 {
        margin: 0;
        font-size: 18px;
        font-weight: bold;
        color: #333;
    }

    .store-info p {
        margin: 5px 0;
        font-size: 14px;
        color: #555;
    }

    .store-actions {
        margin-top: 10px;
    }

    .store-actions button {
        padding: 6px 12px;
        font-size: 14px;
        border-radius: 6px;
        border: 1px solid #aaa;
        background-color: #f9f9f9;
        color: 333;
        margin-right: 10px;
        cursor: pointer;
    }

    .store-actions a {
        padding: 6px 12px;
        font-size: 14px;
        text-decoration: none;
        color: rgb(98, 98, 98);
    }

    .store-actions a:hover {
        color: #000;
        font-style: bold;
    }

</style>
</head>
<body>
    @include('components.admin.navbar')
    <div class='content'>
        @foreach ($stores as $store)
        <div class="store-card">
            <div class="store-image">
                <img src="https://cdn-icons-png.flaticon.com/512/1829/1829586.png" alt="Icon Produk">
            </div>
            <div class="store-info">
                <h3>{{ $store->store_name }}</h3>
                <p>Pemilik: {{ $store->user->name }}</p>
                <p>Kontak: {{ $store->phone }}</p>
                <p>Berdiri Sejak: {{ \Carbon\Carbon::parse($store->created_at)->format('d F Y') }}</p>
                <p>Jumlah Produk: {{ $store->products_count }}</p>
                <p>Jumlah Total Transaksi: 10</p>
                <div class="store-actions">
                    <a href="{{ route('admin.detailseller', ['id' => $store->id]) }}">Lihat Detail</a>
                    <button>Hapus Toko</button>
                </div>
            </div>
        </div>
        @endforeach

        @if ($stores->isEmpty())
            <p>Tidak ada toko yang terdaftar.</p>
        @endif
    </div>



</body>
@include('components.admin.footer')
