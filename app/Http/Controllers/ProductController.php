<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
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

    public function detailProduct($id)
    {
        $product = Product::with(['optionGroups.options'])->findOrFail($id);
        return view('product-detail', compact('product'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return view('search', ['products' => collect(), 'query' => '']);
        }

        $products = Product::where('product_name', 'like', "%{$query}%")->get();

        return view('search', compact('products', 'query'));
    }


}
