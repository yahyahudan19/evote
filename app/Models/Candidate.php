<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Candidate extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'ketua_name',
        'wakil_name',
        'candidate_number',
        'description',
        'ketua_image_path',
        'wakil_image_path',
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
