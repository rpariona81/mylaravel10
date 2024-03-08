<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $table = 't_sessions';
    //
    protected $appends = ['expires_at'];

    public function isExpired()
    {
        return $this->timestamp < Carbon::now()->subMinutes($this->config['sess_expiration'])->getTimestamp();
    }

    public function getExpiresAtAttribute()
    {
        return Carbon::createFromTimestamp($this->timestamp)->addMinutes($this->config['sess_expiration'])->toDateTimeString();
    }
}
