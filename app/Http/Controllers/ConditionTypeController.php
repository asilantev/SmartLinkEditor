<?php

namespace App\Http\Controllers;

use App\Models\ConditionField;
use App\Models\ConditionType;
use Illuminate\Http\Request;

class ConditionTypeController extends Controller
{
    public function index()
    {
        $conditionTypes = ConditionType::all();
        return view('condition_types.index', compact('conditionTypes'));
    }

    public function create()
    {
        $conditionFields = ConditionField::all();
        return view('condition_types.create', compact('conditionFields'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|unique:condition_types|max:255',
            'name' => 'required|max:255',
        ]);

        $conditionType = ConditionType::create($validated);
        $conditionType->fields()->sync($request->input('condition_fields', []));

        return redirect()->route('condition_types.index')->with('success', 'Тип условия успешно создан.');
    }

    public function edit(ConditionType $conditionType)
    {
        $conditionFields = ConditionField::all();
        return view('condition_types.edit', compact('conditionType', 'conditionFields'));
    }

    public function update(Request $request, ConditionType $conditionType)
    {
        $validated = $request->validate([
            'code' => 'required|unique:condition_types,code,'.$conditionType->id.'|max:255',
            'name' => 'required|max:255',
        ]);

        $conditionType->update($validated);
        $conditionType->fields()->sync($request->input('condition_fields', []));

        return redirect()->route('condition_types.index')->with('success', 'Тип условия успешно обновлен.');
    }

    public function destroy(ConditionType $conditionType)
    {
        $conditionType->delete();

        return redirect()->route('condition_types.index')->with('success', 'Тип условия успешно удален.');
    }
}
