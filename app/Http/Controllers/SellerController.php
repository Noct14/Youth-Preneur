<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\DetailSellers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class SellerController extends Controller
{
    public function sellerDashboard()
    {
        $sellerId = 1;
        $productCount = Product::where('seller_id', $sellerId)->count();
        $storeName = DetailSellers::where('id', $sellerId)->value('store_name');
        return view('seller.dashboard', compact('productCount', 'storeName'));
    }

    public function sellerProduct($seller_id = 1)
    {
        $products = Product::where('seller_id', $seller_id)->get();
        return view('seller.productlist', compact('products',));
    }

    public function createProduct()
    {
        $categories = Category::all();
        return view('seller.addproduct', compact('categories'));
    }

    public function storeProduct(Request $request)
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
        $product = Product::create([
            'seller_id' => $sellerId,
            'product_name' => $validated['product_name'],
            'price' => $validated['price'],
            'category_id' => $validated['category_id'],
            'description' => $validated['description'] ?? null,
            'stock' => $validated['stock'] ?? null,
            'image_url' => $imageUrl,
        ]);

        return redirect()->route('products.bySeller')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('seller.editproduct', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'product_name' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|integer',
            'description' => 'nullable|string',
            'stock' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imageUrl = $product->image_url;

        if ($request->hasFile('image')) {
            // Hapus file lama (opsional)
            if ($product->image_url) {
                $oldImagePath = public_path(parse_url($product->image_url, PHP_URL_PATH));
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imageName);
            $imageUrl = asset('uploads/products/' . $imageName);
        }

        $product->update([
            'product_name' => $validated['product_name'],
            'price' => $validated['price'],
            'category_id' => $validated['category_id'],
            'description' => $validated['description'] ?? null,
            'stock' => $validated['stock'] ?? null,
            'image_url' => $imageUrl,
        ]);

        return redirect()->route('products.edit', $product->id)->with('success', 'Produk berhasil diupdate!');
    }



    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image_url) {
            $publicPath = public_path(parse_url($product->image_url, PHP_URL_PATH));

            if (File::exists($publicPath)) {
                File::delete($publicPath);
            }
        }

        $product->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus.');
    }
}
