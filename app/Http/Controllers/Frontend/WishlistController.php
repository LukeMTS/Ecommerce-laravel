<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class WishlistController extends Controller
{   
    public function index()
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        return view('frontend.wishlist', compact('wishlist'));
    }

    public function add(Request $request)
    {
        if(Auth::check())
        {
            $prod_id = $request->product_id;
            if(Product::find($prod_id))
                if(Wishlist::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists())
                {
                    return response()->json(['status' => "Product  Already Added to Wishlist"]);
                }
                else
                {
                    $wish = new Wishlist();

                    $wish->prod_id = $prod_id;
                    $wish->user_id = Auth::id();
                    $wish->save();
                    return response()->json(['status' => "Product Added to Wishlist"]);
                }
            else
            {
                return response()->json(['status' => "Product doesnot exist"]);
            }
        }
        else
        {
            return response()->json(['stauts' => "Login to Continue"]);
        }
    }

    public function deletewishlist(Request $request)
    {
        if(Auth::check())
        {
            $prod_id = $request->prod_id;
            if(Wishlist::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists())
            {
                $wishlist = Wishlist::where('prod_id', $prod_id)->where('user_id', Auth::id())->first();
                $wishlist->delete();

                return response()->json(['status' => "Product Removed Wishlist Successfully"]);
            }
        }   

    }

    public function wishlistcount()
    {
        $wishcount = Wishlist::where('user_id', Auth::id())->count();
        return response()->json(['count' => $wishcount]);
    }
}
