<?php

namespace App\Http\Controllers;
use App\Models\Product;

class SellerController extends Controller
{
    public function getBySeller($seller_id = 2)
    {
        $products = Product::where('seller_id', $seller_id)->get();
        return view('seller.productlist', compact('products'));
    }
}
