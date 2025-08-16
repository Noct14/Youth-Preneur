@include('components.admin.navbar')
<style>
    .tabs {
        display: flex;
        justify-content: center;
        gap: 0.5rem; /* sama dengan space-x-2 */
        padding-top: 1rem; /* sama dengan py-4 */
        padding-bottom: 1rem;
        font-size: 0.875rem; /* text-sm */
    }

    .tab-link,
    .tabs button {
        padding: 0.25rem 0.75rem; /* py-1 px-3 */
        border-radius: 0.25rem;
        text-decoration: none;
        color: #000; /* warna teks hitam */
        background: none;
        border: none;
        cursor: pointer;
        text-align: center;
    }

    .tab-link:hover,
    .tabs button:hover {
        background-color: #E5E7EB; /* hover:bg-gray-200 */
    }

    .tab-active,
    .tabs button.active {
        background-color: #E5E7EB; /* bg-gray-200 */
        font-weight: 600; /* font-semibold */
    }
</style>
<div class="navbar-top-first">
    <a href="{{ route('admin.detailseller', ['id' => $store->id]) }}">Produk</a>
    <a href="#">Transaksi Masuk</a>
    <a href="#">Transaksi Diproses</a>
    <a href="#">Transaksi Selesai</a>
    <a href="#">Pengajuan Penarikan</a>
    <a href="#">Telah Ditarik</a>
</div>


