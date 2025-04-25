<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameVersions extends Model
{
    use HasFactory;

    protected $fillable = [
        'version',
        'game_id',
        'storage_path',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $table = 'game_versions';

    public function games()
    {
        return $this->belongsTo(Games::class, 'game_id', 'id');
    }
}
