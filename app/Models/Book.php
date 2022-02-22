<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    public $fillable = [
        'title',
        'author',
        'image',
        'publish_date',
        'cost',
        'short_description',
        'description',
        'is_active',
        'stock',
    ];	
}
