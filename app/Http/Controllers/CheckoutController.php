<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $user = auth()->user();
        // $cart = Cart::where('user_id', $user->id)->with('items.options')->first();

        $cart = Cart::where('user_id', 1)->with('items.options')->first(); // dummy id

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kosong.');
        }

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => 0,
                'status' => 'pending'
            ]);

            $total = 0;

            foreach ($cart->items as $item) {
                $price = $item->product->price;
                $option_total = $item->options->sum('additional_price');
                $subtotal = ($price + $option_total) * $item->quantity;
                $total += $subtotal;

                $orderItem = $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'note' => $item->note,
                ]);

                if ($item->options->isNotEmpty()) {
                    $orderItem->options()->attach($item->options->pluck('id')->toArray());
                }
            }

            $order->update(['total_price' => $total]);

            $cart->items()->delete();

            DB::commit();

            return redirect()->with('success', 'Checkout berhasil!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Checkout gagal. Silakan coba lagi.');
        }
    }

    public function viewCheckout(Request $request)
    {
        dd($request->all());
    }
}
