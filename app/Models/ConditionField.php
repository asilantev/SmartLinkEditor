<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConditionField extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code'];

    public function conditionTypes()
    {
        return $this->belongsToMany(ConditionType::class, 'condition_type_field');
    }
}
