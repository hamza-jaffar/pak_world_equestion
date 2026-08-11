<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutUsController extends Controller
{
    public function index()
    {
        $aboutUsList = AboutUs::latest()->paginate(10);
        return view('admin.about-us.index', compact('aboutUsList'));
    }

    public function create()
    {
        return view('admin.about-us.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
            'cards' => ['nullable', 'array'],
        ]);

        $cards = [];
        if ($request->has('cards')) {
            foreach ($request->input('cards') as $index => $cardData) {
                $card = [
                    'title' => $cardData['title'] ?? '',
                    'description' => $cardData['description'] ?? '',
                    'icon' => $cardData['icon'] ?? '',
                    'image' => $cardData['existing_image'] ?? '',
                    'video' => $cardData['existing_video'] ?? '',
                ];

                // Check for new image upload
                if ($request->hasFile("cards.{$index}.image")) {
                    $path = $request->file("cards.{$index}.image")->store('about_us', 'public');
                    $card['image'] = Storage::disk('public')->url($path);
                }

                // Check for new video upload
                if ($request->hasFile("cards.{$index}.video")) {
                    $path = $request->file("cards.{$index}.video")->store('about_us', 'public');
                    $card['video'] = Storage::disk('public')->url($path);
                }

                $cards[] = $card;
            }
        }

        AboutUs::create([
            'title' => $validated['title'],
            'question' => $validated['question'],
            'answer' => $validated['answer'],
            'card' => $cards, // maps to json column
        ]);

        return redirect()->route('dashboard.about-us.index')->with('success', 'About Us record created successfully.');
    }

    public function edit(AboutUs $aboutUs)
    {
        return view('admin.about-us.edit', compact('aboutUs'));
    }

    public function update(Request $request, AboutUs $aboutUs)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
            'cards' => ['nullable', 'array'],
        ]);

        $cards = [];
        if ($request->has('cards')) {
            foreach ($request->input('cards') as $index => $cardData) {
                $card = [
                    'title' => $cardData['title'] ?? '',
                    'description' => $cardData['description'] ?? '',
                    'icon' => $cardData['icon'] ?? '',
                    'image' => $cardData['existing_image'] ?? '',
                    'video' => $cardData['existing_video'] ?? '',
                ];

                // Check for new image upload
                if ($request->hasFile("cards.{$index}.image")) {
                    $path = $request->file("cards.{$index}.image")->store('about_us', 'public');
                    $card['image'] = Storage::disk('public')->url($path);
                }

                // Check for new video upload
                if ($request->hasFile("cards.{$index}.video")) {
                    $path = $request->file("cards.{$index}.video")->store('about_us', 'public');
                    $card['video'] = Storage::disk('public')->url($path);
                }

                $cards[] = $card;
            }
        }

        $aboutUs->update([
            'title' => $validated['title'],
            'question' => $validated['question'],
            'answer' => $validated['answer'],
            'card' => $cards,
        ]);

        return redirect()->route('dashboard.about-us.index')->with('success', 'About Us record updated successfully.');
    }

    public function destroy(AboutUs $aboutUs)
    {
        // Delete uploaded media files if any
        if (is_array($aboutUs->card)) {
            foreach ($aboutUs->card as $card) {
                if (!empty($card['image'])) {
                    $path = str_replace(Storage::disk('public')->url(''), '', $card['image']);
                    if (Storage::disk('public')->exists($path)) {
                        Storage::disk('public')->delete($path);
                    }
                }
                if (!empty($card['video'])) {
                    $path = str_replace(Storage::disk('public')->url(''), '', $card['video']);
                    if (Storage::disk('public')->exists($path)) {
                        Storage::disk('public')->delete($path);
                    }
                }
            }
        }

        $aboutUs->delete();

        return redirect()->route('dashboard.about-us.index')->with('success', 'About Us record deleted successfully.');
    }
}
