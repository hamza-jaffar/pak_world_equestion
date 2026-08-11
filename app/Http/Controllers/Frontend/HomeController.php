<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slides;

class HomeController extends Controller
{
    public function index()
    {
        $slides = Slides::latest()->get()->map(function ($slide) {
            return [
                'image'       => $slide->image ? asset('storage/' . $slide->image) : null,
                'title'       => $slide->text,        // 'text' column stores the title
                'text'        => $slide->description,
                'button_text' => $slide->button_text,
                'button_link' => $slide->button_url,
            ];
        })->toArray();

        return view('welcome', compact('slides'));
    }
}
