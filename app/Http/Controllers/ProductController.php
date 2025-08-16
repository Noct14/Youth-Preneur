<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\DetailSellers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function getAllCategories()
    {
        $categories = Category::all();
        return view('home', compact('categories'));
    }

    public function showByCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('category_id', $category->id)->get();

        return view('category', compact('category', 'products'));
    }

    public function showBySeller($id)
    {
        $detailSellers = DetailSellers::findOrFail($id);
        $products = $detailSellers->user->products;

        return view('store-detail', compact('products', 'detailSellers'));
    }


    public function detailProduct($id)
    {
        $product = Product::with(['optionGroups.options', 'detailSellers'])->findOrFail($id);

        $storeName = optional($product->detailSellers)->store_name;
        $storeId = optional($product->detailSellers)->id;

        return view('product-detail', compact('product', 'storeName', 'storeId'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return view('search', ['products' => collect(), 'query' => '']);
        }

        $products = Product::with('seller.DetailSeller')
            ->where('product_name', 'like', "%{$query}%")
            ->get();

        return view('search', compact('products', 'query'));
    }
}
