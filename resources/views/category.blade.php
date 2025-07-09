@livewire('navbar')

@section('title', $category->name)

<style>
    .category-title {
        text-align: center;
        margin-top: 30px;
        font-size: 2em;
        color: #333;
    }

    .product-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        padding: 40px;
    }

    .product-card {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        width: 250px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        text-align: center;
    }

    .product-card h3 {
        font-size: 1.2em;
        color: #333;
        margin-bottom: 10px;
    }

    .product-card p {
        color: #777;
    }
</style>

<div class="category-title">
    Produk di kategori: <strong>{{ $category->name }}</strong>
</div>

<div class="product-grid">
    @forelse ($products as $product)
        <a href="{{ route('detail.Product', $product->id) }}" class="product-card">
            <img src="{{ $product->image_url }}" alt="{{ $product->product_name }}" style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px;">
            <h3>{{ $product->product_name }}</h3>
            <p>Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            @if ($product->seller && $product->seller->DetailSeller && $product->seller->DetailSeller->status === 'approved')
                <h3 class="store-name" style="text-decoration:none">{{ $product->seller->DetailSeller->store_name }}</h3>
            @endif
        </a>
    @empty
        <p>Tidak ada produk di kategori ini.</p>
    @endforelse
</div>


@include('components.footer')
