<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::orderby('id', 'DESC')->paginate('10');
        return view('admin.category.index', compact('categories'));
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

    public function edit($category_id){
        $category= Category::findOrFAil($category_id);
        return view('admin.category.edit', compact('category'));
    }

    public function update (Request $request, $id){
        $validatedData = $request->validate([
            'name' => ['required', 'string'],
            'image' => ['nullable'],
            'description' => ['required', 'string']
        ]);

        $category = Category::findOrFail($id);
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
        $category->update();

        return redirect()->route('admin.category')->with('message', 'Category Updated Successfully');
    }

    public function destroy($id){
        $category = Category::findOrFail($id);
        if(File::exists($category->image)){
            File::delete($category->image);
        }
        $category->delete();
        return redirect()->back()->with('message', 'Category deleted Successfully');
    }
}
