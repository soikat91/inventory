<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Catch_;

class DashBoardController extends Controller
{
    function totalCustomer(Request $request){
        $userID=$request->header('id');
        return Customer::where('user_id',$userID)->count();
    }
    function totalCategory(Request $request){
        $userID=$request->header('id');
        return Category::where('user_id',$userID)->count();
    }
    function totalProduct(Request $request){
        $userID=$request->header('id');
        return Product::where('user_id',$userID)->count();
    }
}
