<?php

namespace App\Models;

use App\Events\SendModelToBrokerEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConditionType extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name'];

    protected $dispatchesEvents = [
        'saved' => SendModelToBrokerEvent::class,
        'deleted' => SendModelToBrokerEvent::class
    ];

    public function conditions()
    {
        return $this->belongsToMany(RuleCondition::class, 'condition_type_id');
    }

    public function fields()
    {
        return $this->belongsToMany(ConditionField::class, 'condition_type_field');
    }
}
