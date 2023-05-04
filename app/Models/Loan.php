<?php

namespace App\Models;

use Carbon\Carbon;
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

    function status()
    {
        $data = (object)[];
        $now = Carbon::now();
        if ($this->delivery_date !== NULL) {
            $data->msg = "Entregado";
            $data->class = "bg-success";
        } else if (Carbon::parse($this->return_date)->isSameDay($now)) {
            $data->msg = "Entrega hoy";
            $data->class = "bg-warning";
        } else if (Carbon::parse($this->return_date)->isPast()) {
            $data->msg = "Atrasado";
            $data->class = "bg-danger";
        } else {
            $data->msg = "Prestado";
            $data->class = "bg-info";
        }

        return $data;
    }
}
