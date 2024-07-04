<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function showHomePage()
    {
        return view('front.page', [
            'page' => Page::where('slug', 'home')->first()
        ]);
    }

    public function showPage($slug)
    {
        return view('front.page', [
            'page' => Page::where('slug', $slug)->first()
        ]);
    }
}
