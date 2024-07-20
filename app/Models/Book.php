<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;
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

    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }
    public function career()
    {
        return $this->belongsTo(Careers::class, 'area');
    }
}
