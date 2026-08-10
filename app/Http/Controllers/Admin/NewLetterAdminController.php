<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewLetter;
use Illuminate\Http\Request;

class NewLetterAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = NewLetter::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('email', 'like', "%{$search}%");
        }

        $subscribers = $query->latest()->paginate(10)->withQueryString();

        return view('admin.newsletters', compact('subscribers'));
    }

    public function destroy(Request $request, NewLetter $newLetter)
    {
        $newLetter->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Newsletter subscriber deleted successfully.',
            ]);
        }

        return redirect()->route('dashboard.newsletters')->with('success', 'Newsletter subscriber deleted successfully.');
    }
}
