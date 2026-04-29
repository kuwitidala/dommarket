<?php

namespace App\Http\Controllers;
use App\Models\Review;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
        {
            Review::create([
                'product_id' => $productId,
                'user_id' => auth()->id(),
                'rating' => $request->rating,
                'text' => $request->text,
            ]);

            return back();
        }
}
