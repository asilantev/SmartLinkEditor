<?php

namespace App\Http\Controllers;

use App\Models\RedirectRule;
use App\Models\SmartLink;
use Illuminate\Http\Request;

class RedirectRuleController extends Controller
{
    public function index()
    {
        $rules = RedirectRule::all();
        return view('redirect_rules.index', compact('rules'));
    }

    public function create()
    {
        $smartLinks = SmartLink::all();
        return view('redirect_rules.create', compact('smartLinks'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'smart_link_id' => 'required|integer|exists:smart_links,id',
            'target_url' => 'required|url',
            'priority' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        RedirectRule::create($validatedData);

        return redirect()->route('redirect_rules.index');
    }

    public function show(RedirectRule $redirectRule)
    {
        return view('redirect_rules.show', compact('redirectRule'));
    }

    public function edit(RedirectRule $redirectRule)
    {
        $smartLinks = SmartLink::all(); // Получаем все умные ссылки
        return view('redirect_rules.edit', compact('redirectRule', 'smartLinks'));
    }

    public function update(Request $request, RedirectRule $redirectRule)
    {
        $validatedData = $request->validate([
            'smart_link_id' => 'required|integer|exists:smart_links,id',
            'target_url' => 'required|url',
            'priority' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        $redirectRule->update($validatedData);

        return redirect()->route('redirect_rules.index');
    }

    public function destroy(RedirectRule $redirectRule)
    {
        $redirectRule->delete();
        return redirect()->route('redirect_rules.index');
    }
}
