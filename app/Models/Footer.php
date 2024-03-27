<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'logo',
        'short_description',
        'button',
        'quicklink',
        'follow',
        'email',
        'phone',
    ];

    protected $casts = [
        'button' => 'json',
        'quicklink' => 'json',
        'follow' => 'json',
    ];
}
