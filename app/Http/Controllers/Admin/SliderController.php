<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slides;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slides::latest()->get();

        return view('admin.slider', compact('sliders'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image'       => ['required', 'image', 'max:2048'],
            'title'       => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'button_text' => ['nullable', 'string', 'max:100'],
            'button_url'  => ['nullable', 'url', 'max:255'],
        ]);

        try {
            $validated['image'] = $request->file('image')->store('sliders', 'public');

            // The DB column is 'text'; the form field is 'title'
            $validated['text'] = $validated['title'] ?? null;
            unset($validated['title']);

            Slides::create($validated);
        } catch (\Throwable $e) {
            report($e); // log it so you can debug later

            return redirect()
                ->route('dashboard.slider')
                ->withInput()
                ->with('error', 'Something went wrong while saving the slider. Please try again.');
        }

        return redirect()
            ->route('dashboard.slider')
            ->with('success', 'Slider created successfully.');
    }

    public function delete(Slides $slider)
    {
        try {
            if ($slider->image) {
                Storage::disk('public')->delete($slider->image);
            }

            $slider->delete();
        } catch (\Throwable $e) {
            report($e);

            return redirect()
                ->route('dashboard.slider')
                ->with('error', 'Something went wrong while deleting the slider. Please try again.');
        }

        return redirect()
            ->route('dashboard.slider')
            ->with('success', 'Slider deleted successfully.');
    }
}
