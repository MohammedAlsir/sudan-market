<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertising extends Model
{
    use HasFactory;
// Begin Relationship
    // Company Function
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
// End Relationship
}
