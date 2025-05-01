<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Log extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_type',
        'user_id',
        'action',
        'description',
        'ip_address',
        'user_agent',
    ];
}
