<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{   

    function product(){
        return view('pages.dashboard.product-page');
    }
    function getProduct(Request $request){
        
        $userId=$request->header('id');    



        return Product::where('user_id',$userId)->get();
    }

    function createProduct(Request $request){

        $userId=$request->header('id');

         // file request kora holo
         $img=$request->file('img');
        //  request time naoya holo
         $time=time();
        //  image er original link naoya holo
         $file_name=$img->getClientOriginalName();
        // $fie_extension=$img->extension();

        // imag name set kra hlo id time file name diye
         $img_name="{$userId}-{$time}-{$file_name}";
        
         //upload  hobe data base a uploads/ image name
         $img_url="uploads/{$img_name}";
 
         //image ta upload hole move kore upload name directory te rakha holo
         $img->move(public_path('uploads'),$img_name);

        return Product::where('user_id',$userId)->create([
            'name'=>$request->input('name'),
            'price'=>$request->input('price'),
            'unit'=>$request->input('unit'),
            'image_url'=>$img_url,
            'category_id'=>$request->input('category_id'),
            'user_id'=>$userId
        ]);

    }
    function updateProduct(Request $request){

        $userId=$request->header('id');
        $product_id=$request->input('id');
        if($request->hasFile('img')){

            $img=$request->file('img');
            $time=time();
            $file_name=$img->getClientOriginalName();
            $img_name="{$userId}-{$time}-{$file_name}";
            $img_url="uploads/{$img_name}";    
            // move image
            $img->move(public_path('uploads'),$img_name);

            $file_path=$request->input('file_path');
            File::delete($file_path);
    
            return Product::where('id',$product_id)->where('user_id',$userId)->update([
                'name'=>$request->input('name'),
                'price'=>$request->input('price'),
                'unit'=>$request->input('unit'),
                'image_url'=>$img_url,
                'category_id'=>$request->input('category_id'),
                'user_id'=>$userId
            ]);
        }else{

            return Product::where('id',$product_id)->where('user_id',$userId)->update([
                'name'=>$request->input('name'),
                'price'=>$request->input('price'),
                'unit'=>$request->input('unit'),              
                'category_id'=>$request->input('category_id'),
                'user_id'=>$userId
            ]);
            
        }
       


        
    }
    function deleteProduct(Request $request){

        $userId=$request->header('id');
        $id=$request->input('id');
        $img_path=$request->input('img_path');
        File::delete($img_path);

        return Product::where('id',$id)->where('user_id',$userId)->delete();



        
    }
}
