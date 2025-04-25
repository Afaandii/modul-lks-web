<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Societies extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = [
        'id_card_number',
        'password',
        'login_tokens',
        'name',
        'born_date',
        'gender',
        'address'
    ];
    public $timestamps = false;

    public function regional()
    {
        return $this->belongsTo(Regionals::class, 'regional_id', 'id');
    }
}
