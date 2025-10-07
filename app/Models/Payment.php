<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'student_reg',
        'branch_id',
        'amount',
        'method',
        'number',
        'status',
    ];
}
