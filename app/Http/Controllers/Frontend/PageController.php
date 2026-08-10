<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Pages;

class PageController extends Controller
{
    public function page(string $slug)
    {
        $page = Pages::where('slug', $slug)->where('is_active', true)->first();

        if (! $page) {
            abort(404);
        }

        return view('slug', compact('page'));
    }
}
