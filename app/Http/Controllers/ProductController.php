<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function getProduct(Request $request){
        
        $userId=$request->header('id');
        return Product::where('user_id',$userId)->get();
    }

    function createProduct(Request $request){

        $userId=$request->header('id');

        return Product::where('user_id',$userId)->create([
            'name'=>$request->input('name')
        ]);

    }
    function updateProduct(Request $request){
        
    }
    function deleteProduct(Request $request){
        
    }
}
