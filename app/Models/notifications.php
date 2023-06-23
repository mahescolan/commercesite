<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notifications extends Model
{
    use HasFactory;
    protected $table="notifications";
    protected $fillable = [
        'id', 'message',  'from_id','to_id','status'
    ];
}
