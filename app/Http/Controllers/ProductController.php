<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class ProductController extends Controller
{

    public function index(){
        $Categories = Category::all();
        $Products = Product::with("category")->get();
        // DD($Products[0]);
        return view('product.products',compact('Products','Categories'));
    }

    public function updatePage($id){
        $Categories = Category::all();
        $product = Product::with("category")->find($id);
        // DD($product);
        return view('product.update-product',compact('product','Categories'));
    }

    public function update(Request $request)
    {
        $product = Product::find($request->id);

        $data = $request->all();
            // Handle the image upload
        $data['image'] = $this->verifyAndStoreImage($request, 'image', 'products');

        $product->update($data);

        return redirect()->route('all-products');
    }



    //api section
    public function successResponse($data,$msg=""){
        return response()->json([
            'status'=>true,
            'code' => 200,
            'message' => $msg,
            'data' => $data
        ], 200);
    }

    public function verifyAndStoreImage(Request $request, $filename = 'image', $directory = 'unknown')
    {
        if ($request->hasFile($filename)) {
            if (!$request->file($filename)->isValid()) {
                flash('Invalid image')->error()->important();
                return redirect()->back()->withInput();
            }
            return $request->file($filename)->store('image/' . $directory, 'public');
        }
        return null;
    }


    public function createProduct(Request $request){
        $data = $request->all();
        $data['image'] = $this->verifyAndStoreImage($request, 'image', 'products');
        // DD($data);
        $product = Product::create($data);
        return $this->successResponse($product,"Created Successfully");

    }

    public function getProducts(){
        $products = Product::all();
        //DD($products);
        return $this->successResponse($products);
        
    }

    public function updateProduct(Request $request)
    {
        $product = Product::find($request->id);

        $data = $request->all();
            // Handle the image upload
        $data['image'] = $this->verifyAndStoreImage($request, 'image', 'products');

        $product->update($data);

        return $this->successResponse($product,"Updated Successfully");

    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        // DD($request->id);
        $product->delete();
        return $this->successResponse($product,"Deleted Successfully");

    }

    // public function 
}
