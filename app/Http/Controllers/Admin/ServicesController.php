<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServicesController extends Controller
{
    public function index()
    {
        $services = Services::latest()->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'main_header' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'cards' => ['nullable', 'array'],
            'image' => ['nullable', 'image', 'max:2048'],
            'image_text' => ['nullable', 'string', 'max:255'],
        ]);

        $cards = [];
        if ($request->has('cards')) {
            foreach ($request->input('cards') as $cardData) {
                $cards[] = [
                    'title' => $cardData['title'] ?? '',
                    'icon' => $cardData['icon'] ?? '',
                    'description' => $cardData['description'] ?? '',
                ];
            }
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = Storage::disk('public')->url(
                $request->file('image')->store('services', 'public')
            );
        }

        Services::create([
            'main_header' => $validated['main_header'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'cards' => $cards,
            'image' => $imagePath,
            'image_text' => $validated['image_text'] ?? null,
        ]);

        return redirect()->route('dashboard.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Services $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Services $service)
    {
        $validated = $request->validate([
            'main_header' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'cards' => ['nullable', 'array'],
            'image' => ['nullable', 'image', 'max:2048'],
            'image_text' => ['nullable', 'string', 'max:255'],
        ]);

        $cards = [];
        if ($request->has('cards')) {
            foreach ($request->input('cards') as $cardData) {
                $cards[] = [
                    'title' => $cardData['title'] ?? '',
                    'icon' => $cardData['icon'] ?? '',
                    'description' => $cardData['description'] ?? '',
                ];
            }
        }

        $imagePath = $service->image;
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($service->image) {
                $oldPath = str_replace(Storage::disk('public')->url(''), '', $service->image);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
            $imagePath = Storage::disk('public')->url(
                $request->file('image')->store('services', 'public')
            );
        }

        $service->update([
            'main_header' => $validated['main_header'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'cards' => $cards,
            'image' => $imagePath,
            'image_text' => $validated['image_text'] ?? null,
        ]);

        return redirect()->route('dashboard.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Services $service)
    {
        if ($service->image) {
            $oldPath = str_replace(Storage::disk('public')->url(''), '', $service->image);
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        $service->delete();

        return redirect()->route('dashboard.services.index')->with('success', 'Service deleted successfully.');
    }
}
