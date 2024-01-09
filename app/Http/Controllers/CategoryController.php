<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //

    public function index(){
        $Categories = Category::all();
        return view('category.categories',compact('Categories'));
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
    public function createCategory(Request $request){
        $Category = Category::create($request->all());
        return $this->successResponse($Category,"Created Successfully");

    }

    public function getCategories(){
        $Categories = Category::all();
        return $this->successResponse($Categories);
        //DD($Categorys);
    }

    public function updateCategory(Request $request)
    {
        $Category = Category::find($request->id);

        $Category->update($request->all());

        return $this->successResponse($Category,"Updated Successfully");

    }

    public function deleteCategory($id)
    {
        $Category = Category::find($id);
        // DD($request->id);
        $Category->delete();
        return $this->successResponse($Category,"Deleted Successfully");

    }
}
