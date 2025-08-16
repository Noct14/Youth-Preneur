<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
</head>
<style>
    .dashboard {        
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        padding: 30px;
        background-color: #fff;
    }

    .card {
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }

    .card h3 {
        margin: 0 0 10px;
    }

    .card p {
        font-size: 20px;
        font-weight: bold;
    }
</style>
@include('components.admin.navbar')

<div class="dashboard">
    <div class="card">
        <h3>Jumlah Seller</h3>
        <p>{{$sellersCount}}</p>
    </div>
    <div class="card">
        <h3>Jumlah Buyer</h3>
        <p>{{$buyersCount}}</p>
    </div>
    <div class="card">
        <h3>Transaksi Bulan ini</h3>
        <p>2</p>
    </div>
    <div class="card">
        <h3>Transaksi Hari Ini</h3>
        <p>2</p>
    </div>
</div>
@include('components.admin.footer')