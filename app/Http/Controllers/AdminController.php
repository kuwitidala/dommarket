<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\Shop;

class AdminController extends Controller
{
    public function index()
    {
        if (auth()->user()->role_id !== 1) {
            abort(403);
        }
        return view('admin.admin_panel');
    }
    public function products()
    {
        $products = Product::orderBy('id')->get();
        return view('admin.products.index', compact('products'));
    }
    public function users()
    {
        $users = User::orderBy('id')->get();
        return view('admin.users.index', compact('users'));
    }
    public function shops()
    {
        $shops = Shop::orderBy('id')->get();
        return view('admin.shops.index', compact('shops'));
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image && file_exists(public_path('images/' . $product->image))) {
            unlink(public_path('images/' . $product->image));
        }
        $product->delete();

        return redirect('/admin/products')->with('success', 'Товар удалён!');
    }
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/admin/users')->with('success', 'Удален!');
    }
    public function deleteShop($id)
    {
        $user = Shop::findOrFail($id);
        $user->delete();

        return redirect('/admin/shops')->with('success', 'Удален!');
    }
    public function orders()
    {
        $orders = Order::with(['user', 'items.product'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.orders.index', compact('orders'));
    }
}

