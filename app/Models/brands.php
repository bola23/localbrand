<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brands extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = ['id','name','description','price','stock','created_at','updated_at'];
}
