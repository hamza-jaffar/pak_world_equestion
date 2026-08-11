<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Certifications;
use App\Models\Members;
use App\Models\Portfolios;
use App\Models\Services;
use App\Models\Slides;

class HomeController extends Controller
{
    public function index()
    {
        $slides = Slides::latest()->get()->map(function ($slide) {
            return [
                'image'       => $slide->image ? asset('storage/' . $slide->image) : null,
                'title'       => $slide->text,
                'text'        => $slide->description,
                'button_text' => $slide->button_text,
                'button_link' => $slide->button_url,
            ];
        })->toArray();

        $aboutUs = AboutUs::latest()->first();

        $services = Services::latest()->get();

        $portfolioItems = Portfolios::latest()->get()->map(fn($p) => [
            'image'    => $p->image,
            'title'    => $p->title,
            'category' => $p->category,
            'label'    => $p->label,
            'url'      => $p->url ?? '#',
        ])->toArray();

        $certifications = Certifications::all()->map(fn($c) => [
            'image' => $c->image,
            'alt'   => $c->alt,
        ])->toArray();

        $members = Members::all()->map(fn($m) => [
            'image' => $m->image,
            'alt'   => $m->alt,
        ])->toArray();

        return view('welcome', compact('slides', 'aboutUs', 'services', 'portfolioItems', 'certifications', 'members'));
    }
}
