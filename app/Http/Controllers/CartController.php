<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        return view('cart.index', compact('cartItems', 'total'));
    }
    public function add(Product $product)
    {
        $userId = Auth::id();
        $cartItem = Cart::firstOrCreate(
            ['user_id' => $userId, 'product_id' => $product->id],
            ['quantity' => 1]
        );
        if (!$cartItem->wasRecentlyCreated) {
            $cartItem->increment('quantity');
        }
        return redirect()->back()->with('success', 'Товар добавлен в корзину!');
    }
    public function update(Request $request, Cart $item)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
        $item->update(['quantity' => $request->quantity]);
        return redirect()->route('cart.index')->with('success', 'Количество обновлено!');
    }
    public function remove(Cart $item)
    {
        $item->delete();
        return redirect()->route('cart.index')->with('success', 'Товар удалён из корзины!');
    }
}