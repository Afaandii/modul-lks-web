<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplySocieties extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $updated_at = false;
    public $created_at = false;

    protected $fillable = [
        'job_vacancy_id',
        'society_id',
        'notes',
        'date',
    ];
}