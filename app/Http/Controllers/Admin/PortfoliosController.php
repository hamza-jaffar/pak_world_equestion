<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfoliosController extends Controller
{
    public function index()
    {
        $portfolios = Portfolios::latest()->paginate(10);
        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        return view('admin.portfolios.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => ['required', 'image', 'max:2048'],
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'label' => ['required', 'string', 'max:100'],
            'url' => ['nullable', 'url', 'max:255'],
        ]);

        $imagePath = Storage::disk('public')->url(
            $request->file('image')->store('portfolios', 'public')
        );

        Portfolios::create([
            'image' => $imagePath,
            'title' => $validated['title'],
            'category' => $validated['category'],
            'label' => $validated['label'],
            'url' => $validated['url'] ?? '#',
        ]);

        return redirect()->route('dashboard.portfolios.index')->with('success', 'Portfolio item created successfully.');
    }

    public function edit(Portfolios $portfolio)
    {
        return view('admin.portfolios.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolios $portfolio)
    {
        $validated = $request->validate([
            'image' => ['nullable', 'image', 'max:2048'],
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'label' => ['required', 'string', 'max:100'],
            'url' => ['nullable', 'url', 'max:255'],
        ]);

        $imagePath = $portfolio->image;
        if ($request->hasFile('image')) {
            // Delete old file
            $oldPath = str_replace(Storage::disk('public')->url(''), '', $portfolio->image);
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }

            $imagePath = Storage::disk('public')->url(
                $request->file('image')->store('portfolios', 'public')
            );
        }

        $portfolio->update([
            'image' => $imagePath,
            'title' => $validated['title'],
            'category' => $validated['category'],
            'label' => $validated['label'],
            'url' => $validated['url'] ?? '#',
        ]);

        return redirect()->route('dashboard.portfolios.index')->with('success', 'Portfolio item updated successfully.');
    }

    public function destroy(Portfolios $portfolio)
    {
        $oldPath = str_replace(Storage::disk('public')->url(''), '', $portfolio->image);
        if (Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }

        $portfolio->delete();

        return redirect()->route('dashboard.portfolios.index')->with('success', 'Portfolio item deleted successfully.');
    }
}
