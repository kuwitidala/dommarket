<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::with('shop', 'category')->findOrFail($id);

        $brandProducts = $product->shop
                                  ->products()
                                  ->where('id', '!=', $product->id)
                                  ->get();

        return view('product', compact('product', 'brandProducts'));
    }
    public function create()
    {
        $categories = Category::all(); 
        return view('shop.create-product', compact('categories'));
    }
    public function store(Request $request)
    {
        $shop = auth()->user()->shop;

        if (!$shop) {
            return redirect()->route('shop.create');
        }

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/products'), $imageName);
        }

        do {
            $article = random_int(10000000, 99999999);
        } while (\App\Models\Product::where('article', $article)->exists());

        \App\Models\Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'material' => $request->material,
            'category_id' => $request->category_id,
            'image' => $imageName,
            'shop_id' => $shop->id,
            'article' => $article,
        ]);

        return redirect()->route('shop.dashboard')
            ->with('success', 'Товар создан!');
    }
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image && file_exists(public_path('images/products/' . $product->image))) {
            unlink(public_path('images/products/' . $product->image));
        }
        $product->delete();

        return redirect('shop')->with('success', 'Товар удалён!');
    }
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        if ($product->shop_id !== auth()->user()->shop->id) {
            abort(403);
        }

        return view('shop.edit-product', compact('product', 'categories'));
    }
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($product->shop_id !== auth()->user()->shop->id) {
            abort(403);
        }

        if ($request->hasFile('image')) {

            if ($product->image && file_exists(public_path('images/products/' . $product->image))) {
                unlink(public_path('images/products/' . $product->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/products'), $imageName);

            $product->image = $imageName;
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'material' => $request->material,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('shop.dashboard')->with('success', 'Товар обновлён!');
    }
}