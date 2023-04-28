<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;
    protected $table = "loans";
    protected $fillable = [
        'code',
        'return_date',
        'people_id',
        'book_id'
    ];

    function people()
    {
        return $this->belongsTo(People::class);
    }

    function book()
    {
        return $this->belongsTo(Book::class);
    }
}
