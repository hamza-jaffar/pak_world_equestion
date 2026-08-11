<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificationsController extends Controller
{
    public function index()
    {
        $certifications = Certifications::latest()->paginate(10);
        return view('admin.certifications.index', compact('certifications'));
    }

    public function create()
    {
        return view('admin.certifications.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => ['required', 'image', 'max:2048'],
            'alt' => ['required', 'string', 'max:255'],
        ]);

        $imagePath = Storage::disk('public')->url(
            $request->file('image')->store('certifications', 'public')
        );

        Certifications::create([
            'image' => $imagePath,
            'alt' => $validated['alt'],
        ]);

        return redirect()->route('dashboard.certifications.index')->with('success', 'Certification created successfully.');
    }

    public function edit(Certifications $certification)
    {
        return view('admin.certifications.edit', compact('certification'));
    }

    public function update(Request $request, Certifications $certification)
    {
        $validated = $request->validate([
            'image' => ['nullable', 'image', 'max:2048'],
            'alt' => ['required', 'string', 'max:255'],
        ]);

        $imagePath = $certification->image;
        if ($request->hasFile('image')) {
            $oldPath = str_replace(Storage::disk('public')->url(''), '', $certification->image);
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }

            $imagePath = Storage::disk('public')->url(
                $request->file('image')->store('certifications', 'public')
            );
        }

        $certification->update([
            'image' => $imagePath,
            'alt' => $validated['alt'],
        ]);

        return redirect()->route('dashboard.certifications.index')->with('success', 'Certification updated successfully.');
    }

    public function destroy(Certifications $certification)
    {
        $oldPath = str_replace(Storage::disk('public')->url(''), '', $certification->image);
        if (Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }

        $certification->delete();

        return redirect()->route('dashboard.certifications.index')->with('success', 'Certification deleted successfully.');
    }
}
