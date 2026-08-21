<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerOrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Match customer orders by their registered email or phone
        $orders = Order::with('items.plant')
            ->where(function ($query) use ($user) {
                $query->where('customer_email', $user->email);
                if ($user->phone) {
                    $query->orWhere('customer_phone', $user->phone);
                }
            })
            ->latest()
            ->paginate(5);

        return view('account.orders', compact('user', 'orders'));
    }
}
