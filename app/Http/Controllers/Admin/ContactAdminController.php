<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $contacts = $query->latest()->paginate(10)->withQueryString();

        return view('admin.contacts', compact('contacts'));
    }

    public function destroy(Request $request, Contact $contact)
    {
        $contact->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Contact message deleted successfully.',
            ]);
        }

        return redirect()->route('dashboard.contacts')->with('success', 'Contact message deleted successfully.');
    }
}
