<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function add(Request $request)
    {
        $stars_rated = $request->product_rating;
        $product_id  = $request->product_id;

        $product_check = Product::where('id', $product_id)->where('status', '1')->first();

        if($product_check)
        {
            $verified_purchase = Orders::where('orders.user_id', Auth::id())
            ->join('orders_items', 'orders.id', 'orders_items.order_id')
            ->where('orders_items.prod_id', $product_id)->get();
        
            if($verified_purchase)
            {

            }
            else
            {
                return redirect()->back()->with('status', 'You cannot rate a product without purchase');
            }
        }
        else
        {
            return redirect()->back()->with('status', 'You cannot rate a product without purchase');
        }
        
    }
}
