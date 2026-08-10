<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            Contact::create($validated);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Your message has been sent successfully!',
                ]);
            }

            return redirect()->to(route('contact') . '#contact-form')
                ->with('success', 'Your message has been sent successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to save contact message: '.$e->getMessage());

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong while sending your message. Please try again.',
                ], 500);
            }

            return redirect()->to(route('contact') . '#contact-form')
                ->withInput()
                ->with('error', 'Something went wrong while sending your message. Please try again.');
        }
    }
}
