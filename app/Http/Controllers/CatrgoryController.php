<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CatrgoryController extends Controller
{
    function listCategory(Request $request){

        $userId=$request->header('id');
       return Category::where('user_id',$userId)->get();

    }

    function createCategory(Request $request){
        $userId=$request->header('id');
       return Category::where('user_id',$userId)->create([
            'name'=>$request->input('name'),
            'user_id'=>$userId
        ]);
    }

    function updateCategory(Request $request){
       
        $id=$request->input('id');
        $userId=$request->header('id');
       return Category::where('id',$id)->where('user_id',$userId)->update([
            'name'=>$request->input('name')     
                    
        ]);
    }
    function deleteCategory(Request $request){

        $id=$request->input('id');
        $userId=$request->header('id');
        return Category::where('id',$id)->where('user_id',$userId)->delete();
    }



    function category(){
        return view('pages.dashboard.categroy-page');
    }
}
