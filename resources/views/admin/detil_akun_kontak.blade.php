@include('admin.detil_akun')

<style>
    .content {
        padding:48px;
    }

    .buyer-card {
        display: flex;
        padding: 20px;
        border-radius: 10px;
        background-color: #ffffff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
        border: 1px solid #ddd;
    }

    .buyer-image {
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

    .buyer-image img {
        width: 60%;
        opacity: 0.3;
    }

    .buyer-info {
        flex: 1;
    }

    .buyer-info h3 {
        margin: 0;
        font-size: 18px;
        font-weight: bold;
        color: #333;
    }

    .buyer-info p {
        margin: 5px 0;
        font-size: 14px;
        color: #555;
    }

    .buyer-actions {
        margin-top: 10px;
    }

    .buyer-actions button {
        padding: 6px 12px;
        font-size: 14px;
        border-radius: 6px;
        border: 1px solid #aaa;
        background-color: #f9f9f9;
        color: #333;
        margin-right: 10px;
        cursor: pointer;
    }

</style>

<div class='content'>
    <div class="buyer-card">
        <div class="buyer-image">
            <img src="https://cdn-icons-png.flaticon.com/512/1829/1829586.png" alt="Icon Pembeli">
        </div>
        <div class="buyer-info">
            <h3>{{ $buyer->name }}</h3>
            <p>Email: {{ $buyer->email }}</p>
            <p>Pengguna Sejak: {{ \Carbon\Carbon::parse($buyer->created_at)->format('d F Y') }}</p>
            <p>Total Transaksi: 5</p>
            <p>Transaksi Belum Dibayar: 1</p>
            <p>Transaksi Diproses: 1</p>
            <p>Transaksi Selesai: 3</p>
                <div class="buyer-actions">
                    <button>Lihat Detail</button>
                    <button>Hapus Pembeli</button>
                </div>
        </div>
    </div>
</div>
@include('components.admin.footer')