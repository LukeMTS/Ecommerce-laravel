<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use Auth;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $old_cartItems = Cart::where('user_id', Auth::id())->get();
        foreach($old_cartItems as $item)
        {
            if(!Product::where('id', $item->prod_id)->where('qty', '>=', $item->prod_qty)->exists())
            {
                $removeItem = Cart::where('user_id', Auth::id())->where('prod_id', $item->prod_id)->first();
                $removeItem->delete();
            }
        }    
        $cartItems = Cart::where('user_id', Auth::id())->get();

        return view('frontend.checkout', compact('cartItems'));
    }

    public function placeorder(Request $request)
    {
        $order = new Order();

        $order->user_id        = Auth::id();
        $order->fname          = $request->fname;
        $order->lname          = $request->lname;
        $order->email          = $request->email;
        $order->phone          = $request->phone;
        $order->address1       = $request->address1;
        $order->address2       = $request->address2;
        $order->city           = $request->city;
        $order->state          = $request->state;
        $order->country        = $request->country;
        $order->pincode        = $request->pincode;

        $order->payment_mode   = $request->payment_mode;
        $order->payment_id     = $request->payment_id;
        
        
        //To Calculate the total price
        $total = 0;

        $cartitems_total = Cart::where('user_id', Auth::id())->get();
        foreach ($cartitems_total as $prod)
        {
            $total += $prod->products->selling_price * $prod->prod_qty;
        }

        $request->total_price = $total;

        $order->total_price = $request->total_price;

        

        $order->tracking_no = 'sharma'.rand(1111,9999);
        $order->save();



        $cartItems = Cart::where('user_id', Auth::id())->get();
        foreach($cartItems as $item)
        {
            OrderItem::create([
                'order_id' => $order->id,
                'prod_id' => $item->prod_id,
                'price' => $item->products->selling_price,
                'qty' => $item->prod_qty,
            ]);

            $prod = Product::where('id', $item->prod_id)->first();
            $prod->qty = $prod->qty - $item->prod_qty;
            $prod->update();
        }

        if(Auth::user()->adress1 == NULL)
        {
            $user = User::where('id', Auth::id())->first();

            $user->name     = $request->fname;
            $user->lname    = $request->lname;
            $user->phone    = $request->phone;
            $user->address1 = $request->address1;
            $user->address2 = $request->address2;
            $user->city     = $request->city;
            $user->state    = $request->state;
            $user->country  = $request->country;
            $user->pincode  = $request->pincode;

            $user->update();
        }

        $cartItems = Cart::where('user_id', Auth::id())->get();
        Cart::destroy($cartItems);

        if($request->payment_mode == "Paid by Razorpay")
        {
            return response()->json(['status' => "Order placed Successfully"]);
        }
        return redirect('/')->with('status', "Order placed Successfully");
    }

    public function razorpaycheck(Request $request)
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        $total_price = 0;
        foreach($cartItems as $item)
        {
            $total_price += $item->products->selling_price * $item->prod_qty;
        }

        $firstname = $request->firstname;
        $lastname  = $request->lastname;
        $email     = $request->email;
        $phone     = $request->phone;
        $address1  = $request->address1;
        $address2  = $request->address2;
        $city      = $request->city;
        $state     = $request->state;
        $country   = $request->country;
        $pincode   = $request->pincode;

        return response()->json([
            'firstname'   => $firstname,
            'lastname'    => $lastname,
            'email'       => $email,
            'phone'       => $phone,
            'address1'    => $address1,
            'address2'    => $address2,
            'city'        => $city,
            'state'       => $state,
            'country'     => $country,
            'pincode'     => $pincode,
            'total_price' => $total_price,
        ]);
        
    }
}

