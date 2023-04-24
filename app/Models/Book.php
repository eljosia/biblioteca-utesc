<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $fillable = [
        'folio',
        'isbn',
        'title',
        'autor',
        'description',
        'editorial',
        'area',
        'quantity',
        'country',
        'date_of_pub',
        'pages',
        'shelf',
        'status',
        'created_by',
        'updated_by',
        'classification_id',
        'date_of_acq',
    ];
}
