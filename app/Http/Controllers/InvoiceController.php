<?php

namespace App\Http\Controllers;


use Exception;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\InvoiceProduct;
use Faker\Extension\Extension;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{   
    function invoice(){
        return view('pages.dashboard.sale-page');

    } 


    function invoiceReportList(){
        return view('pages.dashboard.invoice-page');
    }
    function invoiceCreate(Request $request){      

        try{
            DB::beginTransaction();  //ekta data insert korle 2 ta table a data insert hole tar jnno DB::beginTransaction use kora hoye jate data kno table data na dhukle problem hbe na
            $userId=$request->header('id');
            $invoice= Invoice::create([
    
                'total'=>$request->input('total'),
                'discount'=>$request->input('discount'),
                'vat'=>$request->input('vat'),
                'payable'=>$request->input('payable'),
                'user_id'=>$userId,
                'customer_id'=>$request->input('customer_id'),
    
            ]);

            $invoiceID=$invoice->id;

            $products=$request->input('products');

            foreach($products as $product){

                InvoiceProduct::create([
                    'user_id'=>$userId,
                    'invoice_id'=>$invoiceID,
                    'product_id'=>$product['product_id'],
                    'qty'=>$product['qty'],
                    'sale_price'=>$product['sale_price'],
                ]);

            }

            DB::commit();///sob kisu thik thak thakle eti use kora hy
            return 1;

        }catch(Exception $e){

            DB::rollBack();//jdi kno data kno table a miss korlee tahle ager obsthay database a data niye jabe
            return 0;
        }
    }

    function invoiceList(Request $request){

        $userId=$request->header('id');
         return Invoice::where('user_id',$userId)->with('customer')->get();
    }


    function invoiceDelete(Request $request){

        try{
            DB::beginTransaction();
            $useId=$request->header('id');
            Invoice::where('user_id',$useId)->where('id',$request->input('invoice_id'))->delete();
            InvoiceProduct::where('user_id',$useId)->where('invoice_id',$request->input('invoice_id'))->delete();
            DB::commit();
            return 1;
        }catch(Extension $e){
            
            DB::rollBack();
            return 0;
        }

    }

    function invoiceDetails(Request $request){

        $userId=$request->header('id');

        $customer=Customer::where('user_id',$userId)->where('id',$request->input('cus_id'))->first();
        $invoice=Invoice::where('user_id',$userId)->where('id',$request->input('inv_id'))->first();
        $InvoiceProduct=InvoiceProduct::where('user_id',$userId)->where('invoice_id',$request->input('inv_id'))->get();

        return [
            'customer'=>$customer,
            'invoice'=>$invoice,
            'product'=>$InvoiceProduct,
        ];

    }
}
