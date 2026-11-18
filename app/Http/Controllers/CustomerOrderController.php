<?php
namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;
class CustomerOrderController extends Controller
{
 public function index(Request $request)
    {
        $user = $request->user();

        // Jika user belum login, arahkan ke halaman login
        if (!$user) {
            return redirect()->route('login');
        }

        // Amankan jika relasi orders belum ada
        $orders = method_exists($user, 'orders') 
            ? $user->orders()->latest('ordered_at')->paginate(10) 
            : collect();
        
        return view('orders.index', compact('orders'));
    }
 public function show(Request $request, Order $order): View
 {
 abort_unless($order->user_id === $request->user()->id, 403);
 $order->load('items');
 return view('orders.show', compact('order'));
 }
}