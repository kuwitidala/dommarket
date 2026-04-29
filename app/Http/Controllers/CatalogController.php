<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CatalogController extends Controller
{
    public function index(Request $request, $slug = null)
    {
        $query = Product::query();
        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }
        $category = null;
        if ($slug) {
            $category = Category::where('slug', $slug)->firstOrFail();
            $query->where('category_id', $category->id);
        }
        $products = $query->get();
        $categories = Category::all();
        return view('catalog', compact('products', 'categories', 'category'));
    }
}