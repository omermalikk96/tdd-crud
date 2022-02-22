<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends Model
{
    use HasFactory;
    public $fillable = [
        'product_name',
        'product_desc',
        'product_qty'
    ];	
}
