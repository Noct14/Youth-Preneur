@include('admin.detil_toko')
<style>
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        padding: 50px;
    }
    .product-card {
        border: 1px solid #ccc;
        border-radius: 10px;
        overflow: hidden;
        background-color: #fff;
        margin: 3%;
    }
    .product-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        display: block;
        margin-left: auto;
        margin-right: auto;
        background-color: #eee;
    }
    .product-card .info {
        padding: 15px;  
    }
    .product-card .info h4 {
        margin: 0 0 5px;
        font-size: 16px;
    }
    .product-card .info p {
        margin: 0;
        font-size: 14px;
    }
    .product-card .info p.price {
        font-weight: bold;
        margin-bottom: 5px;
    }
    .product-card .info p.seller {
        color: #777;
        font-size: 13px;
    }
    .btn-group-view {
        margin-top: 10px;
        display: flex;
        justify-content: flex-end;
    }
    .btn-view {
        color: #E5E7EB;
        background-color: black;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
    }
    .btn-view:hover {
        color: #fff;
    }
</style>

<div class="product-grid">
    @forelse ($products as $product)
        <div class="product-card">
            {{-- Pastikan path gambar benar, contoh: public/storage/nama_gambar.jpg --}}
            <img src="{{ $product->image_url }}" alt="{{ $product->product_name }}">
            <div class="info">
                <h4>{{ $product->product_name }}</h4>
                <p class="price">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                <p class="seller">{{ $store->store_name }}</p>
                <div class='btn-group-view'>
                    {{-- Arahkan ke rute detail produk jika ada --}}
                    <a class='btn-view' href="#">Lihat Produk</a>
                </div>
            </div>
        </div>
        
    @empty
        <div style="grid-column: 1 / -1; text-align: center;">
            <p>Toko ini belum memiliki produk.</p>
        </div>
    @endforelse
    
</div>
@include('components.admin.footer')