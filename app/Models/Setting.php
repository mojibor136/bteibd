<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'meta_title',
        'meta_desc',
        'meta_tag',
        'fav_icon',
        'side_logo',
    ];
    
    protected $casts = [
        'meta_tag' => 'array',
    ];
}
