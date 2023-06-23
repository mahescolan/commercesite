<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_details extends Model
{
    use HasFactory;
    protected $table="order_details";
    protected $fillable = [
        'id', 'order_id',  'product_id','quantity','price'
    ];
    public function order_or()
    {
        return $this->belongsTo(orders::class,'order_id');
    }
    public function order_pro()
    {
        return $this->belongsTo(products::class,'product_id');
    }
}
