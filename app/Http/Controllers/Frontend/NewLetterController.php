<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\NewLetter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NewLetterController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        try {
            NewLetter::create(['email' => $validated['email']]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'You have subscribed to our newsletter!',
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Failed to subscribe newsletter: '.$e->getMessage());

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong. Please try again.',
                ], 500);
            }

            return back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again.');
        }

        return back()->with('success', 'You have subscribed to our newsletter!');
    }
}
