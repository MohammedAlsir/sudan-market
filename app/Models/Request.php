<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

// Begin Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Product Function
    public function products()
    {
        return $this->hasMany(Product::class);
    }
// End Relationship
}
