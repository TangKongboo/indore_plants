<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Plant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function getCart()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return response()->json([
            'cart' => $cart,
            'total' => $total,
            'count' => count($cart)
        ]);
    }

    public function add(Request $request)
    {
        $plant = Plant::findOrFail($request->plant_id);
        $qty = $request->quantity ?? 1;

        $cart = session()->get('cart', []);

        if(isset($cart[$plant->id])) {
            $cart[$plant->id]['quantity'] += $qty;
        } else {
            $cart[$plant->id] = [
                'id' => $plant->id,
                'name' => $plant->name,
                'price' => $plant->price,
                'image' => $plant->image_url,
                'quantity' => $qty
            ];
        }

        session()->put('cart', $cart);

        return response()->json(['success' => true, 'message' => 'Item added to cart']);
    }

    public function update(Request $request)
    {
        $plantId = $request->plant_id;
        $qty = $request->quantity;

        $cart = session()->get('cart', []);

        if(isset($cart[$plantId])) {
            if($qty <= 0) {
                unset($cart[$plantId]);
            } else {
                $cart[$plantId]['quantity'] = $qty;
            }
            session()->put('cart', $cart);
        }

        return response()->json(['success' => true]);
    }

    public function remove(Request $request)
    {
        $plantId = $request->plant_id;
        $cart = session()->get('cart', []);

        if(isset($cart[$plantId])) {
            unset($cart[$plantId]);
            session()->put('cart', $cart);
        }

        return response()->json(['success' => true]);
    }
}
