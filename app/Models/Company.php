<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

// Begin Relationship
    // ads Function
    public function ads()
    {
        return $this->hasMany(Advertising::class);
    }

     // product Function
     public function products()
     {
         return $this->hasMany(Product::class);
     }
// End Relationship

}
