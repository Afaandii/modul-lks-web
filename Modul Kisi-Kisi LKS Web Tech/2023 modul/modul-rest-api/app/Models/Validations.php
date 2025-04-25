<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validations extends Model
{
    use HasFactory;

    protected $fillable = [
        'society_id',
        'work_experience',
        'job_category_id',
        'job_position',
        'reason_accepted',
        'status',
        'validator_id',
        'validator_notes',
    ];

    public $timestamps = false;
    public $updated_at = false;
    public $created_at = false;

    public function job_category()
    {
        return $this->belongsTo(JobCategories::class, 'job_category_id', 'id');
    }
}
