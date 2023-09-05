<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model
{
    use HasFactory;
    protected $fillable=['user_id','product_id','invoice_id','qty','sale_price'];

    function product(){

        return $this->belongsTo(Product::class);
    }
}
