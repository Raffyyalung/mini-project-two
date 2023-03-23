<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        return view('admin.category.index');
    }

    public function create(){
        return view('admin.category.create');
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => ['required', 'string'],
            'image' => ['nullable'],
            'description' => ['required', 'string']
        ]);

        $category = New Category;

        $category->name = $validatedData['name'];

        if($request->hasFile('image')){
            $uploadPath = 'uploads/category/';
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time().'.'.$extension;

            $file->move($uploadPath, $fileName);
            $finalImageName = $uploadPath.$fileName;
            
            $category->image = $finalImageName;
        }

        $category->description = $validatedData['description'];
        $category->save();

        return redirect()->route('admin.category')->with('message', 'Category Added Succesfully');
    }
}
