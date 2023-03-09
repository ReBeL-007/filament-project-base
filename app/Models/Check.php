<?php

namespace App\Models;

// use App\Enums\CheckStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Check extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'results' => 'array',
        'completed_at' => 'datetime',
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function lastCheck()
    {
        return $this->hasOne(Check::class)->latestOfMany('created_at');
    }
}
