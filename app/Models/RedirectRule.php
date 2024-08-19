<?php

namespace App\Models;

use App\Events\SendModelToBrokerEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RedirectRule extends Model
{
    use HasFactory;

    protected $fillable = ['smart_link_id', 'target_url', 'priority', 'is_active'];

    protected $dispatchesEvents = [
        'saved' => SendModelToBrokerEvent::class,
        'deleted' => SendModelToBrokerEvent::class
    ];

    public function smartLink()
    {
        return $this->belongsTo(SmartLink::class);
    }

    public function conditions()
    {
        return $this->hasMany(RuleCondition::class, 'rule_id');
    }
}
