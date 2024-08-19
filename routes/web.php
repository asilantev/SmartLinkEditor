<?php

use App\Http\Controllers\ConditionFieldController;
use App\Http\Controllers\ConditionTypeController;
use App\Http\Controllers\RedirectRuleController;
use App\Http\Controllers\RuleConditionController;
use App\Http\Controllers\SmartLinkController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('condition_types', ConditionTypeController::class);
Route::resource('smart_links', SmartLinkController::class);
Route::resource('redirect_rules', RedirectRuleController::class);
Route::resource('rule_conditions', RuleConditionController::class);
Route::resource('condition_fields', ConditionFieldController::class);
