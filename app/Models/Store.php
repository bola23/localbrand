<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sellers;

class Store extends Model
{
    use HasFactory;
    protected $table ="stores";
    protected $fillable = [
        'seller_id',
        'name',
        'description',
        'status',
    ];

    // Define the relationship with the Seller model
    public function seller()
    {
        return $this->belongsTo(Sellers::class);
    }
}
