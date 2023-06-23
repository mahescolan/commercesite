<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;
    protected $table="products";
   protected $fillable=['name','price','image','Quantity','status','admin_id','category_id','register_id'];
   public function createdBy()
    {
        return $this->belongsTo(category::class, 'category_id');
    }
    public function product_r()
    {
        return $this->belongsTo(products::class,'admin_id');
    }
    public function shops()
    {
        return $this->hasMany(shop::class, 'products_id');
    }
    public function cart()
    {
        return $this->hasMany(carts::class, 'products_id');
    }
    
}
