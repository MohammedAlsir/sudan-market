<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
// Begin Relationship
    // Company Function
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Comments Function
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Section Function
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

     // Request Function
     public function request()
     {
         return $this->belongsTo(Request::class);
     }

// End Relationship
}
