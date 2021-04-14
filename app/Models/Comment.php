<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
// Begin Relationship
    // Function User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

     // Function Products
     public function product()
     {
         return $this->belongsTo(Product::class);
     }
// End Relationship

}
