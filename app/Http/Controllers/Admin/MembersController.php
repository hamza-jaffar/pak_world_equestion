<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MembersController extends Controller
{
    public function index()
    {
        $members = Members::latest()->paginate(10);
        return view('admin.members.index', compact('members'));
    }

    public function create()
    {
        return view('admin.members.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => ['required', 'image', 'max:2048'],
            'alt' => ['required', 'string', 'max:255'],
        ]);

        $imagePath = Storage::disk('public')->url(
            $request->file('image')->store('members', 'public')
        );

        Members::create([
            'image' => $imagePath,
            'alt' => $validated['alt'],
        ]);

        return redirect()->route('dashboard.members.index')->with('success', 'Member created successfully.');
    }

    public function edit(Members $member)
    {
        return view('admin.members.edit', compact('member'));
    }

    public function update(Request $request, Members $member)
    {
        $validated = $request->validate([
            'image' => ['nullable', 'image', 'max:2048'],
            'alt' => ['required', 'string', 'max:255'],
        ]);

        $imagePath = $member->image;
        if ($request->hasFile('image')) {
            $oldPath = str_replace(Storage::disk('public')->url(''), '', $member->image);
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }

            $imagePath = Storage::disk('public')->url(
                $request->file('image')->store('members', 'public')
            );
        }

        $member->update([
            'image' => $imagePath,
            'alt' => $validated['alt'],
        ]);

        return redirect()->route('dashboard.members.index')->with('success', 'Member updated successfully.');
    }

    public function destroy(Members $member)
    {
        $oldPath = str_replace(Storage::disk('public')->url(''), '', $member->image);
        if (Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }

        $member->delete();

        return redirect()->route('dashboard.members.index')->with('success', 'Member deleted successfully.');
    }
}
