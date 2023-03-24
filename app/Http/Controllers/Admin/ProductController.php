<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index(){
        $products = Product::orderby('id', 'DESC')->paginate(10);
        return view('admin.product.index', compact('products'));
    }

    public function create(){
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'category_id' => ['required', 'integer'],
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'price' => ['required', 'integer'],
            'status' => ['nullable'],
            'image' => ['nullable'],
        ]);

        $category = Category::findOrFail($validatedData['category_id']);

        $product = $category->products()->create([
            'category_id' => $validatedData['category_id'],
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'status' => $request->status == true ? '1':'0',
        ]);

        if($request->hasFile('image')){
            $uploadPath = 'uploads/product/';
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time().".".$extension;

            $file->move($uploadPath,$fileName);
            $finalImageName = $uploadPath.$fileName;

            $product->image = $finalImageName;
        }

        $product->save();

        return redirect()->route('admin.product')->with('message', 'Product Added Successfully');
    }
    
    public function edit($product_id){
        $categories = Category::all();
        $product = Product::findOrFail($product_id);
        return view('admin.product.edit', compact('product','categories'));
    }

    public function update(Request $request, $product_id){
        $validatedData = $request->validate([
            'category_id' => ['required', 'integer'],
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'price' => ['required', 'integer'],
            'status' => ['nullable'],
            'image' => ['nullable'],
        ]);

        $product = Category::findOrFail($validatedData['category_id'])->products()->where('id', $product_id)->first();

        if($product){
            $product->update([
                'category_id' => $validatedData['category_id'],
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'price' => $validatedData['price'],
                'status' => $request->status == true ? '1':'0',
            ]);
    
            if($request->hasFile('image')){
                $uploadPath = 'uploads/product/';
                if(File::exists($product->image)){
                    File::delete($product->image);
                }
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $fileName = time().".".$extension;
    
                $file->move($uploadPath,$fileName);
                $finalImageName = $uploadPath.$fileName;
    
                $product->image = $finalImageName;
            }
            $product->update();
    
            return redirect()->route('admin.product')->with('message', 'Product Updated Successfully');
        }
        }
       
        public function destroy($product_id){
            $product = Product::findOrFail($product_id);
            if(File::exists($product->image)){
                File::delete($product->image);
            }
            $product->delete();
            return redirect()->back()->with('message', 'Category deleted Successfully');
        }
}
