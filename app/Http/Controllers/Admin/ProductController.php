<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('admin.products.index', compact('products'));
    }

    public function add(Request $request)
    {
        $category = Category::all();

        return view('admin.products.add', compact('category'));
    }

    public function insert(Request $request)
    {
        $products = new Product();

        if($request->hasFile('image') && $request->file('image')->isValid())
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time(). '.' .$ext;
            $file->move(public_path('assets/uploads/product'), $filename);
            $products->image = $filename;
        }

        $products->cate_id               = $request->cate_id;
        $products->name                  = $request->name;  
        $products->small_description     = $request->small_description;   
        $products->description           = $request->description;
        $products->qty                   = $request->qty;
        $products->slug                  = $request->slug;
        $products->original_price        = $request->original_price;
        $products->selling_price         = $request->selling_price;
        $products->tax                   = $request->tax;
        $products->status                = $request->status == TRUE ? '1' : '0';
        $products->trending              = $request->trending == TRUE ? '1' : '0';
        $products->meta_title            = $request->meta_title;
        $products->meta_keywords         = $request->meta_keywords;
        $products->meta_description      = $request->meta_description;    

        $products->save();

        return redirect('products')->with('status', 'Product Added Successfully');

    }

    public function edit($id)
    {
        $products = Product::findOrFail($id);

        $category = Category::all();

        return view('admin.products.edit', compact('products', 'category'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if($request->hasFile('image'))
        {
            $path = 'assets/uploads/product/'.$product->image;
            if(File::exists($path))
            {
                File::delete($path);
            }     
            $file       = $request->file('image');
            $ext        = $file->getClientOriginalExtension();
            $filename   = time().'.'.$ext;   
            $file->move('assets/uploads/product/',$filename);   

            $product->image = $filename;     
        }

        $product->cate_id           = $request->cate_id;
        $product->name              = $request->name;
        $product->small_description = $request->small_description;
        $product->description       = $request->description;
        $product->qty               = $request->qty;
        $product->slug              = $request->slug;
        $product->original_price    = $request->original_price;
        $product->selling_price     = $request->selling_price;
        $product->tax               = $request->tax;
        $product->status            = $request->status == TRUE ? '1':'0';
        $product->trending          = $request->trending == TRUE ? '1':'0';
        $product->meta_title        = $request->meta_title;
        $product->meta_keywords     = $request->meta_keywords;
        $product->meta_description  = $request->meta_description;
        $product->update();
        

        return redirect('products')->with('status', 'Product Update Successfully');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if($product->image)
        {
            $path = 'assets/uploads/product/'.$product->imag;
            if(File::exists($path))
            {
                File::delete($path);
            }
        }

        $product->delete();

        return redirect('products')->with('status', 'Product Deleted Successfully !');

    }
}
