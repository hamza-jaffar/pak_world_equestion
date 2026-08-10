<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Pages::latest()->paginate(10);

        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'in:privacy-policy,terms-of-service', 'unique:pages,slug'],
            'content' => ['required', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        Pages::create($validated);

        return redirect()->route('dashboard.pages')->with('success', 'Page created successfully.');
    }

    public function edit(Pages $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Pages $page)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'in:privacy-policy,terms-of-service', 'unique:pages,slug,' . $page->id],
            'content' => ['required', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        $page->update($validated);

        return redirect()->route('dashboard.pages')->with('success', 'Page updated successfully.');
    }

    public function destroy(Pages $page)
    {
        $page->delete();

        return redirect()->route('dashboard.pages')->with('success', 'Page deleted successfully.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => ['required', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
        ]);

        $path = $request->file('file')->store('pages', 'public');

        return response()->json([
            'location' => Storage::disk('public')->url($path),
        ]);
    }
}
