<?php

namespace App\Models;

use App\Events\SendModelToBrokerEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmartLink extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'default_url', 'expires_at'];
    protected $dates = ['expires_at'];

    protected $dispatchesEvents = [
        'saved' => SendModelToBrokerEvent::class,
        'deleted' => SendModelToBrokerEvent::class
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function redirectRules()
    {
        return $this->hasMany(RedirectRule::class);
    }
}
