<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regionals extends Model
{
    use HasFactory;

    protected $fillable = [
        'province',
        'distric',
    ];

    public function societies()
    {
        return $this->hasMany(Societies::class, 'regional_id', 'id');
    }
}
