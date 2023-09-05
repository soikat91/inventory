<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Catch_;

class DashBoardController extends Controller
{
    // function totalCustomer(Request $request){
    //     $userID=$request->header('id');
    //     return Customer::where('user_id',$userID)->count();
    // }
    // function totalCategory(Request $request){
    //     $userID=$request->header('id');
    //     return Category::where('user_id',$userID)->count();
    // }
    // function totalProduct(Request $request){
    //     $userID=$request->header('id');
    //     return Product::where('user_id',$userID)->count();
    // }

    // function totalInvoice(Request $request){
        
    //     $userID=$request->header('id');

    //     return Invoice::where('user_id',$userID)->count();
    // }    

    // function totalSale(Request $request){
        
    //     $userID=$request->header('id');
    //     return Invoice::where('user_id',$userID)->sum('total');
    // }

    // function vatCollection(Request $request){

    //     $userID=$request->header('id');
    //     return Invoice::where('user_id',$userID)->sum('vat');
    // }
    // function totalCollection(Request $request){

    //     $userID=$request->header('id');
    //     return Invoice::where('user_id',$userID)->sum('payable');
    // }



    function summery(Request $request){

        $userID=$request->header('id');
        $customer=Customer::where('user_id',$userID)->count();
        $category=Category::where('user_id',$userID)->count();
        $product=Product::where('user_id',$userID)->count();
        $invoice=Invoice::where('user_id',$userID)->count();
        $sale=Invoice::where('user_id',$userID)->sum('total');
        $vat=Invoice::where('user_id',$userID)->sum('vat');
        $payable=Invoice::where('user_id',$userID)->sum('payable');


        return [
            'customer'=>$customer,
            'category'=>$category,
            'product'=>$product,
            'invoice'=>$invoice,
            'sale'=>round( $sale,2) ,
            'vat'=>round($vat,2),
            'payable'=>round($payable,2)
        ];


    }
}
