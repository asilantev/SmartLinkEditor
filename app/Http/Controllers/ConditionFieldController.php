<?php

namespace App\Http\Controllers;

use App\Models\ConditionField;
use Illuminate\Http\Request;

class ConditionFieldController extends Controller
{
    public function index()
    {
        $conditionFields = ConditionField::all();
        return view('condition_fields.index', compact('conditionFields'));
    }

    public function create()
    {
        return view('condition_fields.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:condition_fields',
        ]);

        ConditionField::create($request->all());
        return redirect()->route('condition_fields.index')->with('success', 'Поле условия успешно создано.');
    }

    public function show(ConditionField $conditionField)
    {
        return view('condition_fields.show', compact('conditionField'));
    }

    public function edit(ConditionField $conditionField)
    {
        return view('condition_fields.edit', compact('conditionField'));
    }

    public function update(Request $request, ConditionField $conditionField)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:condition_fields,code,' . $conditionField->id,
        ]);

        $conditionField->update($request->all());
        return redirect()->route('condition_fields.index')->with('success', 'Поле условия успешно обновлено.');
    }

    public function destroy(ConditionField $conditionField)
    {
        $conditionField->delete();
        return redirect()->route('condition_fields.index')->with('success', 'Поле условия успешно удалено.');
    }
}
