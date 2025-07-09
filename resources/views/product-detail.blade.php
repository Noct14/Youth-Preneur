@livewire('navbar')

<title>Detail Produk</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #fff;
    }

    .product-detail-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        max-width: 1200px;
        margin: 40px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    /* Product Image Section */
    .product-image-section {
        flex: 1;
        min-width: 300px;
        max-width: 480px;
        background-color: #f5f5f5;
        border-radius: 8px;
        overflow: hidden;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 40px;
    }

    .product-image-section img {
        max-width: 80%; /* Disesuaikan untuk membuat ikon lebih kecil secara proporsional */
        height: auto;
        display: block;
        /* opacity: 0.3; */
        padding: 30px; /* DIKECILKAN: Padding sekitar ikon placeholder */
    }

    .favorite-button {
        position: absolute;
        top: 20px;
        left: 20px;
        background-color: rgba(0,0,0,0.6);
        color: #fff;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1.5em;
        cursor: pointer;
        border: none;
        outline: none;
        z-index: 10;
    }

    /* Product Details Section - START OF TARGETED CHANGES */
    .product-details-section {
        flex: 2;
        min-width: 350px;
        padding-left: 20px;
        display: flex;
        flex-direction: column;
    }

    .product-details-section h1 {
        font-size: 1.9em;
        color: #333;
        margin-top: 0;
        margin-bottom: 5px;
    }

    .product-details-section .price {
        font-size: 2.1em;
        font-weight: bold;
        color: #000;
        margin-bottom: 10px;
    }

    .product-details-section .store-name {
        font-size: 0.95em;
        color: #777;
        margin-bottom: 20px;
    }

    .options-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .options-row div {
        flex: 1;
        min-width: 140px;
    }

    .options-row label {
        display: block;
        font-size: 0.85em;
        color: #555;
        margin-bottom: 5px;
    }

    .options-row select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 0.9em;
        background-color: #fff;
        cursor: pointer;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http://www.w3.org/2000/svg%22%20viewBox%3D%220%200%20256%20256%22%3E%3Cpath%20fill%3D%22%23666%22%20d%3D%22M128%20160L0%2032h256z%22/%3E%3C/svg%3E');
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 10px;
    }

    .add-to-cart-button {
        width: 100%;
        padding: 12px;
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 1em;
        cursor: pointer;
        margin-bottom: 25px;
        transition: background-color 0.2s ease-in-out;
    }

    .add-to-cart-button:hover {
        background-color: #555;
    }

    /* Product Description (Collapsible) */
    .product-description-toggle {
        background-color: #f9f9f9;
        border: 1px solid #eee;
        border-radius: 5px;
        margin-bottom: 25px;
        overflow: hidden;
    }

    .product-description-header {
        padding: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: bold;
        cursor: pointer;
        background-color: #f9f9f9;
        color: #333;
        font-size: 0.95em;
    }

    .product-description-header .arrow {
        transition: transform 0.3s ease;
        font-size: 1.1em;
    }

    .product-description-header.collapsed .arrow {
        transform: rotate(0deg);
    }

    .product-description-header.expanded .arrow {
        transform: rotate(180deg);
    }

    .product-description-content {
        padding: 0 15px;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out, padding 0.3s ease-out;
        will-change: max-height;
    }

    .product-description-content.expanded {
        max-height: 200px;
        padding-bottom: 15px;
    }

    .product-description-content p {
        margin: 0;
        color: #555;
        line-height: 1.5;
        font-size: 0.9em;
    }
    /* Product Details Section - END OF TARGETED CHANGES */


    /* Review Section - KEPT AS ORIGINAL */
    .review-section {
        width: 100%;
        margin-top: 40px;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .review-section h2 {
        font-size: 1.6em;
        color: #333;
        margin-bottom: 25px;
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
    }

    .review-cards-container {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .review-card {
        background-color: #f9f9f9;
        border: 1px solid #eee;
        border-radius: 8px;
        padding: 20px;
        flex: 1;
        min-width: 280px;
        max-width: 350px;
        display: flex;
        flex-direction: column;
    }

    .review-card .stars {
        color: #FFD700;
        font-size: 1.2em;
        margin-bottom: 10px;
    }

    .review-card .review-title {
        font-weight: bold;
        color: #333;
        margin-bottom: 8px;
        font-size: 1.1em;
    }

    .review-card .review-text {
        color: #555;
        font-size: 0.95em;
        margin-bottom: 15px;
        line-height: 1.5;
        flex-grow: 1;
    }

    .reviewer-info {
        display: flex;
        align-items: center;
        margin-top: 10px;
    }

    .reviewer-info img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
        object-fit: cover;
    }

    .reviewer-info .name {
        font-weight: bold;
        color: #333;
        font-size: 0.9em;
    }

    .reviewer-info .date {
        font-size: 0.8em;
        color: #888;
        margin-left: auto;
    }

    /* Responsive Adjustments */
    @media (max-width: 1000px) {
        .product-image-section {
            margin-right: 0;
            margin-bottom: 20px;
            max-width: none;
            width: 100%;
        }

        .product-details-section {
            padding-left: 0;
            width: 100%;
            min-width: unset;
        }
    }

    @media (max-width: 600px) {
        .product-detail-container {
            margin: 20px;
            padding: 15px;
        }

        .product-details-section h1 {
            font-size: 1.8em;
        }

        .product-details-section .price {
            font-size: 2em;
        }

        .options-row {
            flex-direction: column;
            gap: 15px;
        }

        .options-row div {
            min-width: unset;
            width: 100%;
        }

        .review-section {
            padding: 15px;
            margin-top: 30px;
        }

        .review-card {
            min-width: unset;
            width: 100%;
            margin-bottom: 15px;
        }
    }
</style>

<script>
    function toggleDescription(header) {
        const content = header.nextElementSibling; // Get the content div
        const arrow = header.querySelector('.arrow'); // Get the arrow span

        if (content.classList.contains('expanded')) {
            content.classList.remove('expanded');
            header.classList.remove('expanded');
            header.classList.add('collapsed');
        } else {
            content.classList.add('expanded');
            header.classList.add('expanded');
            header.classList.remove('collapsed');
        }
    }

</script>

<div class="product-detail-container">
    <div class="product-image-section">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="width: 100%; max-width: 400px;">
    </div>

    <div class="product-details-section">
        <h1>{{ $product->product_name }}</h1>
        <div class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>

        <a class="store-name" href="{{ route('store.show', $product->seller->DetailSeller->id) }}">{{ $product->seller->DetailSeller->store_name }}</a>

        {{-- notif success and error add to cart --}}
        @if (session('success'))
            <div class="alert alert-success" style="padding: 10px; margin-bottom: 10px; background-color: #d4edda; color: #155724;">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger" style="padding: 10px; margin-bottom: 10px; background-color: #f8d7da; color: #721c24;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" value="1">

            <div class="options-row">
                @if ($product->optionGroups && $product->optionGroups->isNotEmpty())
                    @foreach ($product->optionGroups as $group)
                        <div class="option-row">
                            <label>{{ $group->name }}</label>
                            <select name="options[]">
                                <option value="">-- Tidak memilih {{ strtolower($group->name) }} --</option>
                                @foreach ($group->options as $option)
                                    <option value="{{ $option->id }}">
                                        {{ $option->name }} (+{{ number_format($option->additional_price, 0, ',', '.') }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach
                @endif
            </div>

            <button type="submit" class="add-to-cart-button">Tambah Ke Keranjang</button>
        </form>


        <div class="product-description-toggle">
            <div class="product-description-header collapsed" onclick="toggleDescription(this)">
                <span>Keterangan Produk</span>
                <span class="arrow">&#9660;</span> </div>
            <div class="product-description-content">
                <p>{{ $product->description ?? '-' }}</p>
            </div>
        </div>
    </div>
</div>

{{-- <div class="review-section">
    <h2>Ulasan Pembeli</h2>
    <div class="review-cards-container">
        <div class="review-card">
            <div class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <div class="review-title">Mantap</div>
            <div class="review-text">Lanjutkan</div>
            <div class="reviewer-info">
                <img src="https://via.placeholder.com/40/FF69B4/FFFFFF?text=R" alt="Reviewer Avatar">
                <span class="name">Reviewer name</span>
                <span class="date">Date</span>
            </div>
        </div>

        <div class="review-card">
            <div class="stars">&#9733;&#9733;&#9733;&#9733;&#9734;</div>
            <div class="review-title">Rasanya Manis</div>
            <div class="review-text">Tapi bukan pemanis buatan</div>
            <div class="reviewer-info">
                <img src="https://via.placeholder.com/40/87CEEB/FFFFFF?text=R" alt="Reviewer Avatar">
                <span class="name">Reviewer name</span>
                <span class="date">Date</span>
            </div>
        </div>

        <div class="review-card">
            <div class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <div class="review-title">Tehnya Wangi bgt</div>
            <div class="review-text"></div> <div class="reviewer-info">
                <img src="https://via.placeholder.com/40/90EE90/FFFFFF?text=R" alt="Reviewer Avatar">
                <span class="name">Reviewer name</span>
                <span class="date">Date</span>
            </div>
        </div>

        </div>
</div> --}}


@include('components.footer')
