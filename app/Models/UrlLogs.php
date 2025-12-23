<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UrlLogs extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'url_id',
        'ip_address',
        'user_agent',
        'browser',
    ];
}
