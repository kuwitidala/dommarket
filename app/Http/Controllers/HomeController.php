<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function loadMore(Request $request)
    {
        $offset = $request->offset ?? 0;
        $limit = $request->limit ?? 5;

        $products = \App\Models\Product::with('shop')
            ->latest()
            ->skip($offset)
            ->take($limit)
            ->get();

        return response()->json($products);
    }
    public function loadPopular(Request $request)
    {
        $offset = $request->offset ?? 0;
        $limit = $request->limit ?? 4;

        $products = \App\Models\Product::with('shop')
            ->orderBy('rating', 'desc') // 🔥 популярные сверху
            ->skip($offset)
            ->take($limit)
            ->get();

        return response()->json($products);
    }
    public function loadPopularShops(Request $request)
    {
        $offset = $request->offset ?? 0;
        $limit = $request->limit ?? 3;

        $shops = \App\Models\Shop::orderByDesc('rating')
            ->skip($offset)
            ->take($limit)
            ->get();

        return response()->json($shops);
    }
}
