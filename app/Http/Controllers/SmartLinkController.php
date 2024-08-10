<?php

namespace App\Http\Controllers;

use App\Models\SmartLink;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SmartLinkController extends Controller
{
    public function index()
    {
        $smartLinks = SmartLink::paginate(10);
        return view('smart_links.index', compact('smartLinks'));
    }

    public function create()
    {
        return view('smart_links.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug' => 'required|unique:smart_links,slug|max:255',
            'default_url' => 'required|url',
            'expires_at' => 'nullable|date',
        ]);

        $validated['expires_at'] = $this->parseExpiresAt($validated['expires_at']);

        SmartLink::create($validated);

        return redirect()->route('smart_links.index')
            ->with('success', 'Умная ссылка успешно создана.');
    }

    public function show(SmartLink $smartLink)
    {
        return view('smart_links.show', compact('smartLink'));
    }

    public function edit(SmartLink $smartLink)
    {
        return view('smart_links.edit', compact('smartLink'));
    }

    public function update(Request $request, SmartLink $smartLink)
    {
        $validated = $request->validate([
            'slug' => 'required|unique:smart_links,slug,' . $smartLink->id . '|max:255',
            'default_url' => 'required|url',
            'expires_at' => 'nullable|date',
        ]);

        $validated['expires_at'] = $this->parseExpiresAt($validated['expires_at']);

        $smartLink->update($validated);

        return redirect()->route('smart_links.index')
            ->with('success', 'Умная ссылка успешно обновлена.');
    }

    public function destroy(SmartLink $smartLink)
    {
        $smartLink->delete();

        return redirect()->route('smart_links.index')
            ->with('success', 'Умная ссылка успешно удалена.');
    }

    private function parseExpiresAt($date)
    {
        return $date ? Carbon::parse($date) : null;
    }
}
