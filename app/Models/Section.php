<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
// Begin Relationship
    public function products()
    {
        return $this->hasMany(Product::class);
    }
// End Relationship
}
