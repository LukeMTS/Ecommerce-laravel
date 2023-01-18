<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();

        return view('admin.category.index', compact('category'));
    }

    public function add()
    {
        return view('admin.category.add');
    }

    public function insert(Request $request)
    {
        $category = new Category();

        if($request->hasFile('image') && $request->file('image')->isValid())
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time(). '.' .$ext;
            $file->move(public_path('assets/uploads/category'), $filename);
            $category->image = $filename;
        }

        $category->slug          = $request->slug;
        $category->name          = $request->name;
        $category->description   = $request->description;
        $category->status        = $request->status == TRUE ? '1':'0';
        $category->popular       = $request->popular == TRUE ? '1':'0';
        $category->meta_title    = $request->meta_title;
        $category->meta_descrip  = $request->meta_descrip;
        $category->meta_keywords = $request->meta_keywords;
        $category->save();

        return redirect('/dashboard')->with('status', 'Category Added Successfully');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        if($request->hasFile('image'))
        {
            $path = 'assets/uploads/category/'.$category->image;
            if(File::exists($path))
            {
                File::delete($path);
            }

            $file     = $request->file('image');
            $ext      = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/category/',$filename);

            $category->image = $filename;
        }

        $category->slug          = $request->slug;
        $category->name          = $request->name;
        $category->description   = $request->description;
        $category->status        = $request->status == TRUE ? '1':'0';
        $category->popular       = $request->popular == TRUE ? '1':'0';
        $category->meta_title    = $request->meta_title;
        $category->meta_descrip  = $request->meta_descrip;
        $category->meta_keywords = $request->meta_keywords;
        $category->update();

        return redirect('dashboard')->with('status', 'Category Update Successfully');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if($category->image)
        {
            $path = 'assets/uploads/category/'.$category->image;
            if(File::exists($path))
            {
                File::delete($path);
            }
        }

        $category->delete();

        return redirect('categories')->with('status', 'Category Deleted Successfully !');
    }
}
