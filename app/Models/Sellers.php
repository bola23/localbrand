<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sellers extends Model
{
    use HasFactory;

    protected $table = "sellers";
    protected $fillable = ['id' , 'user_id' , 'firstName', 'lastName', 'phone', 'email' , 'ID_NO' , 'ID_photo', 'created_at', 'updated_at'];
}
