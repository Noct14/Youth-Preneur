@livewire('navbar')

<title>Keranjang Belanja</title>
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

    .page-main-header {
        font-weight: bold;
        font-size: 1.8em; /* Tetap sama untuk judul halaman */
        padding-bottom: 30px;
        margin-bottom: 30px;
        border-bottom: 1px solid #eee;
    }

    .cart-entry {
        margin-bottom: 40px;
        padding-bottom: 40px;
        border-bottom: 1px solid #eee;
    }

    .cart-entry:last-of-type {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .item-card {
        display: flex;
        align-items: flex-start;
        width: 100%;
        box-sizing: border-box;
    }

    .item-placeholder {
        width: 100px; /* Diperkecil dari 150px */
        height: 100px; /* Diperkecil dari 150px */
        background-color: #f0f0f0;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 20px; /* Diperkecil dari 30px */
        border-radius: 4px;
        flex-shrink: 0;
        margin-bottom: 15px;
    }

    .item-placeholder img {
        width: 70%;
        height: 70%;
        opacity: 0.5;
    }

    .item-details {
        flex-grow: 1;
    }

    .item-name {
        font-weight: bold;
        font-size: 1.2em; /* Diperkecil dari 1.8em */
        margin-bottom: 8px; /* Diperkecil dari 15px */
    }

    .item-info {
        font-size: 0.9em; /* Diperkecil dari 1.1em */
        color: #555; /* Sedikit lebih gelap agar kontras */
        margin-bottom: 5px; /* Diperkecil dari 8px */
    }

    .item-actions {
        margin-top: 15px; /* Diperkecil dari 20px */
        display: flex;
        gap: 10px; /* Diperkecil dari 15px */
    }

    .item-actions button {
        padding: 8px 20px; /* Diperkecil padding */
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f8f8f8;
        cursor: pointer;
        font-size: 0.9em; /* Diperkecil dari 1em */
        transition: background-color 0.2s ease-in-out;
    }

    .item-actions button.hapus {
        background-color: #e0e0e0;
    }

    .item-actions button:hover {
        background-color: #ddd;
    }

    .footer-checkout {
        width: 100%;
        padding: 30px 60px;
        text-align: right;
        background-color: #ffffff;
        box-sizing: border-box;
        border-top: 1px solid #eee;
        margin-top: 0;
    }

    .checkout-button {
        background-color: #333;
        color: white;
        padding: 15px 30px;
        border: none;
        border-radius: 5px;
        font-size: 1.1em;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out;
    }

    .checkout-button:hover {
        background-color: #555;
    }

    @media (max-width: 768px) {
        .main-content-wrapper {
            padding: 20px;
        }

        .item-card {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .item-placeholder {
            width: 80px; /* Lebih kecil di mobile */
            height: 80px; /* Lebih kecil di mobile */
            margin-right: 0;
            margin-bottom: 10px; /* Kurangi margin bawah di mobile */
        }

        .item-name {
            font-size: 1.2em; /* Sesuaikan ukuran font di mobile */
        }

        .item-info {
            font-size: 0.85em; /* Sesuaikan ukuran font di mobile */
        }

        .item-actions {
            flex-direction: column;
            gap: 8px; /* Kurangi gap di mobile */
        }

        .item-actions button {
            padding: 8px 15px; /* Sesuaikan padding tombol di mobile */
            font-size: 0.85em;
        }

        .footer-checkout {
            padding: 20px;
        }
    }
</style>

<body>
    <div class="main-content-wrapper">
        <div class="page-main-header">Keranjang Belanja</div>
        @if(session('success'))
            <div style="padding: 10px; background-color: #d4edda; color: #155724; border-radius: 5px; margin: 15px;">
                {{ session('success') }}
            </div>
        @endif
        @if($cart && $cart->items->count())
            @foreach($cart->items as $item)
                <div class="cart-entry">
                    <div class="item-card">
                        <div class="item-placeholder">
                            <img src="{{ $item->product->image_url ?? 'https://via.placeholder.com/100' }}" alt="{{ $item->product->product_name }}">
                        </div>
                        <div class="item-details">
                            <div class="item-name">
                                <label>
                                    {{ $item->product->product_name }} (Rp. {{ number_format($item->product->price, 0, ',', '.') }})
                                </label>
                            </div>

                            @if($item->options->isNotEmpty())
                                <div class="item-info">
                                    {{ $item->options->pluck('name')->join(', ') }}
                                </div>
                            @endif

                            <div class="item-info">
                                ({{ $item->quantity }} x Rp.{{ number_format($item->product->price, 0, ',', '.') }})
                            </div>

                            <div class="item-actions">
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="hapus">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <form action="{{ route('view.checkout') }}" method="POST" class="footer-checkout">
                @csrf
                @foreach($cart->items as $item)
                    <input type="hidden" name="cart[item {{ $loop->index }}][product_id]" value="{{ $item->product->id }}">
                    <input type="hidden" name="cart[item {{ $loop->index }}][quantity]" value="{{ $item->quantity }}">
                    <input type="hidden" name="cart[item {{ $loop->index }}][price]" value="{{ $item->product->price }}">
                @endforeach
                <button class="checkout-button">Lanjut Pembayaran</button>
            </form>
        @else
            <div class="text-gray-600 p-4">Keranjang kamu kosong 😢</div>
        @endif
    </div>
</body>

<script>
    function showAlert() {
        alert('ini button kemana?');
        return false;}
</script>

@include('components.footer')
