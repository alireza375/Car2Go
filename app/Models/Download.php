<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image1',
        'image2',
        'short_description',
        'button'
    ];


    protected $casts = [
        'button' => 'json'
    ];

}
