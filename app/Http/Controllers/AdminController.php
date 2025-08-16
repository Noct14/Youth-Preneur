<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\DetailSellers;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        $sellersCount = User::where('role', 'seller')->count();
        $buyersCount = User::where('role', 'user')->count();
        return view('admin.dashboard', compact('sellersCount', 'buyersCount'));
    }

    //Seller
    public function getAllSeller()
    {
        $stores = DetailSellers::with('user')
            ->where('status', 'approved')
            ->get();
        foreach ($stores as $store)
        {
            $store->products_count = Product::where('seller_id', $store->id)->count();
        }
        return view('admin.daftar_toko', ['stores' => $stores]);
    }

    public function getDetailSeller($id)
    {
        $store = DetailSellers::with('user')->findOrFail($id);
        $products = Product::where('seller_id', $store->id)->get();
        return view('admin.detil_toko_produk', [
            'store' => $store,
            'products' => $products
        ]);
    }

    //Buyer
    public function getAllBuyer()
    {
        $buyers = User::where('role', 'user')
            ->select('id', 'name', 'email', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.daftar_pembeli', ['buyers' => $buyers]);
    }

    public function getDetailBuyer($id)
    {
        $buyer = User::where('id', $id)
            ->where('role', 'user')
            ->firstOrFail();
        return view('admin.detil_akun_kontak', ['buyer' => $buyer]);
    }

    //Transaction

    //Category
    public function getAllCategory()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('admin.kategori', compact('categories'));
    }

    public function addCategory(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string|max:255|unique:categories']);
        Category::create($validated);
        return redirect()->route('admin.category')->with('success', 'Category created successfully.');
    }

    public function editCategory(Request $request, $id)
    {
        $validated = $request->validate(['name' => 'required|string|max:255|unique:categories,name,' . $id]);
        $category = Category::findOrFail($id);
        $category->update($validated);
        return redirect()->route('admin.category')->with('success', 'Category successfully updated.');
    }

    public function deleteCategory($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->route('admin.category')->with('success', 'Category successfully deleted.');
    }
}
