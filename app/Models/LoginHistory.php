<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'logged_in_at',
        'ip_address',
        'browser',
        'os',
    ];

    protected $casts = [
        'logged_in_at' => 'datetime', // Add this line
    ];
}

