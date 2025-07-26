<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Voter extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'birth_date',
        'code',
        'status',
        'id_card_number',
        'email_sent_at',
    ];
}
