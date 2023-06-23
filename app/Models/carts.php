<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carts extends Model
{
    use HasFactory;
    protected $table="carts";
    protected $fillable = [
        'admin_id',
        'product_id',
        'product_qty',
        
    ];
    public function cartsPro()
    {
        return $this->belongsTo(products::class, 'product_id');
    }
    public function cartsUs()
    {
        return $this->belongsTo(admin::class, 'admin_id');
    }
    public function cartsqty()
    {
        return $this->belongsTo(products::class, 'product_qty');
    }

}
