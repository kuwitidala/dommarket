<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.product')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('order', compact('orders'));
    }

    public function create()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return view('checkout', compact('cartItems'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:500',
            'selected_items' => 'required|array|min:1', 
        ]);
        $userId = Auth::id();
        $selectedCartIds = $request->selected_items;
        $cartItems = Cart::with('product')
            ->where('user_id', $userId)
            ->whereIn('id', $selectedCartIds)
            ->get();
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Выберите товары для оформления.');
        }
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->product->price * $item->quantity;
        }
        $order = Order::create([
            'user_id' => $userId,
            'address' => $request->address,
            'total' => $total,
        ]);
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }
        Cart::where('user_id', $userId)->whereIn('id', $selectedCartIds)->delete();
        return redirect('/order')->with('success', 'заказ оформлен!');
    }
    public function show($id)
    {
        $order = Order::with('items.product')->where('user_id', Auth::id())->findOrFail($id);
        return view('orders.show', compact('order'));
    }
}