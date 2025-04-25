<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplyPositions extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $updated_at = false;
    public $created_at = false;

    protected $fillable = [
        'society_id',
        'job_vacancy_id',
        'position_id',
        'job_apply_societies_id',
        'date',
    ];
}