<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;
    protected $table = "peoples";
    protected $filletable = [
        'name',
        'last_name',
        'phone',
        'tuition',
        'employee_number',
        'grade',
        'group',
        'career',
    ];
}
