<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Games extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'created_by',
        'created_at',
        'updated_at',
    ];

    protected $table = 'games';

    //aksesor untuk upload timestamp
    public function getUploadTimestampAttribute()
    {
        return $this->created_at;
    }

    public function scores()
    {
        return $this->hasMany(Scores::class, 'game_version_id', 'id');
    }

    public function getScore()
    {
        return $this->scores()->sum('score');
    }

    public function gameVersions()
    {
        return $this->hasMany(GameVersions::class, 'game_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
