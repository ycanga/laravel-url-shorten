<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllUrls extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'short_url',
        'clicks',
        'user_id',
    ];
}
