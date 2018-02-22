<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
    public function __construct() {}

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('pages.landing');
    }
}
