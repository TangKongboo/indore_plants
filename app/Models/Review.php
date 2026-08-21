<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'plant_id',
        'reviewer_name',
        'reviewer_role',
        'rating',
        'comment',
        'is_approved',
    ];

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }
}
