<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
   
class admin extends Model implements Authenticatable
{
    use HasFactory;

    protected $table="admin";
    protected $guard="admin";
   
    protected $fillable=['name','email','password','role','address'];
    
    
    
    public function admin()
    {
      return $this->hasMany(products::class,'admin_id');
    }
    public function admin_C()
    {
      return $this->hasMany(carts::class,'admin_id');
    }
    public function admin_Order()
    {
      return $this->hasMany(orders::class,'admin_id');
    }
        
        public function getAuthIdentifierName()
        {
            return 'id';
        }
    
        public function getAuthIdentifier()
        {
            return $this->id;
        }
    
        public function getAuthPassword()
        {
            return $this->password;
        }
    
        public function getRememberToken()
        {
            return $this->remember_token;
        }
    
        public function setRememberToken($value)
        {
            $this->remember_token = $value;
        }
    
        public function getRememberTokenName()
        {
            return 'remember_token';
        }
        
        
    }
    

