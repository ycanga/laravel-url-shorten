<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AllUrls extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'url',
        'short_url',
        'clicks',
        'user_id',
        'channel',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function logs()
    {
        return $this->hasMany(UrlLogs::class, 'url_id');
    }
}
