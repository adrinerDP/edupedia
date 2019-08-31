<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiDocsController extends Controller
{
    public function intro()
    {
        return view('pages.api_docs.intro');
    }

    public function region()
    {
        return view('pages.api_docs.region');
    }

    public function office()
    {
        return view('pages.api_docs.office');
    }

    public function school()
    {
        return view('pages.api_docs.school');
    }

    public function meal()
    {
        return view('pages.api_docs.meal');
    }

    public function calendar()
    {
        return view('pages.api_docs.calendar');
    }
}
