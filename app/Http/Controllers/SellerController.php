<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use Illuminate\Support\Str;

class SellerController extends Controller
{
    public function getBySeller($seller_id = 2)
    {
        $products = Product::where('seller_id', $seller_id)->get();
        return view('seller.productlist', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('seller.addproduct', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|integer',
            'description' => 'nullable|string',
            'stock' => 'nullable|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // $sellerId = auth()->id();
        $sellerId = 2;
        $imageUrl = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imageName);
            $imageUrl = asset('uploads/products/' . $imageName);
        }
        // dd($validated);
        $product = Product::create([
            'seller_id' => $sellerId,
            'product_name' => $validated['product_name'],
            'price' => $validated['price'],
            'category_id' => $validated['category_id'],
            'description' => $validated['description'] ?? null,
            'stock' => $validated['stock'] ?? null,
            'image_url' => $imageUrl,
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
        dd($request->all());

    }

}
