<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrators extends Model
{
    use HasFactory;

    protected $table = "administrators";

    protected $fillable = [
        'username',
        'password',
        'last_login',
        'created_at',
        'updated_at',
    ];
}
