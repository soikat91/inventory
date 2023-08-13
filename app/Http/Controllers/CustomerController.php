<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{   
    function customer(){
        
        return view('pages.dashboard.customer-page');
    }
    
    function getCustomer(Request $request){

        $userId=$request->header('id');
       return Customer::where('user_id',$userId)->get();

    }

    function createCustomer(Request $request){
        $userId=$request->header('id');
       return Customer::where('user_id',$userId)->create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'mobile'=>$request->input('mobile'),
            'user_id'=>$userId,
        ]);
    }

//customer update korar jnno customer id bar kore nicu erpr customer id niye data soho kore update korbo
    function customerById(Request $request){        
        $id=$request->input('id');
        $userId=$request->header('id');
        return Customer::where('id',$id)->where('user_id',$userId)->first();
    }

    function updateCustomer(Request $request){
       
        $id=$request->input('id');
        $userId=$request->header('id');
       return Customer::where('id',$id)->where('user_id',$userId)->update([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'mobile'=>$request->input('mobile'),          
        ]);
    }
    function deleteCustomer(Request $request){

        $id=$request->input('id');
        $userId=$request->header('id');
        return Customer::where('id',$id)->where('user_id',$userId)->delete();
    }
}
