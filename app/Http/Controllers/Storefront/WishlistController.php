<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = auth()->user()->wishlists()->with('plant')->get();
        return view('account.wishlist', compact('wishlists'));
    }

    public function toggle(Request $request)
    {
        $request->validate(['plant_id' => 'required|exists:plants,id']);

        $wishlist = Wishlist::where('user_id', auth()->id())
            ->where('plant_id', $request->plant_id)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            return response()->json(['status' => 'removed']);
        } else {
            Wishlist::create([
                'user_id' => auth()->id(),
                'plant_id' => $request->plant_id
            ]);
            return response()->json(['status' => 'added']);
        }
    }
}
