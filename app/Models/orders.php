<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;
    protected $table="orders";
    protected $fillable = [
        'id', 'order_code',  'admin_id','address','price','status'
    ];
    public function order_conn()
    {
        return $this->belongsTo(admin::class,'admin_id');
    }
    public function order_details()
    {
        return $this->hasMany(order_details::class,'order_id');
    }
}
