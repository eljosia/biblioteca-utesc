<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Book extends Model
{
    use HasFactory;
    use LogsActivity;
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
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name', 'text']);
        // Chain fluent methods for configuration options
    }
}
