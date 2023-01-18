<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class CartController extends Controller
{
    public function addProduct(Request $request)
    {
        $product_id  = $request->product_id;
        $product_qty = $request->product_qty;

        if (Auth::check()) {
            $prod_check = Product::where('id', $product_id)->first();

            if ($prod_check) {
                if ($prod_check->qty < $product_qty) {
                    return response()->json(['status' => "Exceeded stock quantity, current stock quantity: " . $prod_check->qty]);
                }

                if (Cart::where('prod_id', $product_id)->where('user_id', Auth::id())->exists()) {
                    return response()->json(['status' => $prod_check->name . " Already Added to cart"]);
                }

                $cartItem = new Cart();

                $cartItem->prod_id  = $product_id;
                $cartItem->user_id  = Auth::id();
                $cartItem->prod_qty = $product_qty;

                $cartItem->save();

                return response()->json(['status' => $prod_check->name . " Added to cart"]);
            }
        } else {
            return response()->json(['status' => "Login to continue"]);
        }
    }

    public function viewcart()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();

        return view('frontend.cart', compact('cartItems'));
    }

    public function updatecart(Request $request)
    {
        $prod_id = $request->prod_id;
        $product_qty = $request->prod_qty;

        if (Auth::check()) {
            if (Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists()) {
                $cart = Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->first();
                $cart->prod_qty = $product_qty;
                $cart->update();

                return response()->json(['status' => "Quantity updated"]);
            }
        }
    }

    public function deleteproduct(Request $request)
    {
        if (Auth::check()) {
            $prod_id = $request->prod_id;

            if (Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists()) {
                $cartItem = Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->first();
                $cartItem->delete();

                return response()->json(['status' => "Product Deleted Successfully"]);
            }
        } else {
            return response()->json(['status' => "Login to continue"]);
        }
    }

    public function cartcount()
    {
        $cartCount = Cart::where('user_id', Auth::id())->count();
        return response()->json(['count' => $cartCount]);
    }
}
