<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;

class CartController extends Controller
{
    public function addCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'options' => 'array',
            'options.*' => 'exists:options,id',
            'quantity' => 'integer|min:1',
        ]);

        $user = auth()->user();
        // Dummy id
        $cart = Cart::firstOrCreate(['user_id' => 1]);
        // $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        $productId = $request->product_id;
        $quantity = $request->quantity ?? 1;
        $optionIds = collect($request->options)->sort()->values()->all(); // sort untuk konsistensi

        // Ambil semua item yang cocok dengan product_id
        $existingItems = $cart->items()->where('product_id', $productId)->get();

        // Cek apakah ada item dengan opsi yang sama
        foreach ($existingItems as $item) {
            $existingOptionIds = $item->options()->pluck('option_id')->sort()->values()->all();

            if ($existingOptionIds === $optionIds) {
                // Item dengan kombinasi sama ditemukan -> update quantity
                $item->quantity += $quantity;
                $item->save();

                return redirect()->back()->with('success', 'Jumlah produk berhasil ditambahkan di keranjang!');
            }
        }

        // Kalau tidak ada, buat item baru
        $cartItem = $cart->items()->create([
            'product_id' => $productId,
            'quantity' => $quantity,
        ]);

        if (!empty($optionIds)) {
            $cartItem->options()->attach($optionIds);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }


    public function viewCart ()
    {
        $cart = Cart::with(['items.product', 'items.options'])->where('user_id', 1)->first();

        return view('cart', compact('cart'));
    }

    public function remove(CartItem $item)
    {
        $item->delete();
        return back()->with('success', 'Item berhasil dihapus dari keranjang');
    }



}
