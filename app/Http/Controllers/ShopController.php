<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Shop;

class ShopController extends Controller
{
    public function create()
    {
        return view('shop.create');
    }
    public function store(Request $request)
    {
        $existingShop = Shop::where('user_id', auth()->id())->first();
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/shops'), $imageName);
        }
        if ($existingShop) {
            return redirect()->route('profile.show')
                ->with('error', 'У вас уже есть магазин');
        }
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        Shop::create([
            'name' => $request->name,
            'user_id' => auth()->id(),
            'image' => $imageName,
        ]);
        return redirect()->route('profile.show')->with('success', 'Магазин создан');
    }
    public function dashboard()
    {
        $shop = auth()->user()->shop;
        if (!$shop) {
            return redirect()->route('profile.show');
        }
        $products = $shop->products;
        return view('shop.dashboard', compact('shop', 'products'));
    }
    public function update(Request $request)
    {
        $shop = auth()->user()->shop;
        if (!$shop) {
            return redirect()->route('shop.create');
        }
        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/shops'), $imageName);

            $data['image'] = $imageName;
        }
        $shop->update($data);
        return redirect()->back()->with('success', 'Магазин обновлён');
    }
    public function show($id)
    {
        $shop = Shop::with('products')->findOrFail($id);
        return view('shop.show', compact('shop'));
    }
    public function loadProducts(Request $request)
{
    return \App\Models\Product::where('shop_id', $request->shop_id)
        ->skip($request->offset)
        ->take($request->limit)
        ->get();
}
}