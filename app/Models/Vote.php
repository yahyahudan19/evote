<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Vote extends Model
{
    use HasFactory, HasUuids;
    
    protected $fillable = [
        'voter_id',
        'candidate_id',
        'voted_at',
    ];

    public function voter()
    {
        return $this->belongsTo(Voter::class);
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
