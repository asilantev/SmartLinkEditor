<?php

namespace App\Http\Controllers;

use App\Models\ConditionType;
use App\Models\RedirectRule;
use App\Models\RuleCondition;
use Illuminate\Http\Request;

class RuleConditionController extends Controller
{
    public function index()
    {
        $ruleConditions = RuleCondition::with(['rule', 'conditionType'])->get()->map(function ($ruleCondition) {
            $ruleCondition->condition_value = json_decode($ruleCondition->condition_value);
            return $ruleCondition;
        });
        $conditionTypes = ConditionType::with('fields')->get();
        return view('rule_conditions.index', compact('ruleConditions', 'conditionTypes'));
    }

    public function create()
    {
        $rules = RedirectRule::all();
        $conditionTypes = ConditionType::with('fields')->get();
        return view('rule_conditions.create', compact('rules', 'conditionTypes'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'rule_id' => 'required|exists:redirect_rules,id',
            'condition_type_id' => 'required|exists:condition_types,id',
            'condition_value' => 'required|array',
        ]);

        $ruleCondition = new RuleCondition();
        $ruleCondition->rule_id = $validatedData['rule_id'];
        $ruleCondition->condition_type_id = $validatedData['condition_type_id'];
        $ruleCondition->condition_value = json_encode($validatedData['condition_value']);
        $ruleCondition->save();

        return redirect()->route('rule_conditions.index');
    }

    public function show(RuleCondition $ruleCondition)
    {
        $ruleCondition->condition_value = json_decode($ruleCondition->condition_value);
        $conditionTypes = ConditionType::with('fields')->get();
        return view('rule_conditions.show', compact('ruleCondition', 'conditionTypes'));
    }

    public function edit(RuleCondition $ruleCondition)
    {
        $ruleCondition->condition_value = json_decode($ruleCondition->condition_value);
        $rules = RedirectRule::all();
        $conditionTypes = ConditionType::with('fields')->get();
        return view('rule_conditions.edit', compact('ruleCondition', 'rules', 'conditionTypes'));
    }

    public function update(Request $request, RuleCondition $ruleCondition)
    {
        $validatedData = $request->validate([
            'rule_id' => 'required|exists:redirect_rules,id',
            'condition_type_id' => 'required|exists:condition_types,id',
            'condition_value' => 'required|array',
        ]);

        $ruleCondition->condition_type_id = $validatedData['rule_id'];
        $ruleCondition->condition_type_id = $validatedData['condition_type_id'];
        $ruleCondition->condition_value = json_encode($validatedData['condition_value']);
        $ruleCondition->save();

        return redirect()->route('rule_conditions.index');
    }

    public function destroy(RuleCondition $ruleCondition)
    {
        $ruleCondition->delete();

        return redirect()->route('rule_conditions.index');
    }
}
