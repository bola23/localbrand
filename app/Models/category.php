<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
   
    protected $table ="category";
    protected $fillable = [
        'id',
        'name',
        'store_id',
    ];

    // Define the relationship with the Seller model
    public function seller()
    {
        return $this->belongsTo(Sellers::class,Store::class);
    }
}
