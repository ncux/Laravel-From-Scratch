<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index () {
        $variable = 'Home';
        return view('pages/index', compact('variable'));
    }

    public function about () {
        $variable = 'About page variable';
        return view('pages/about', compact('variable'));
    }

    public function services () {
        $data = array(
            'title' => 'Services',
            'services' => ['Web development', 'DevOps', 'AndShit']
        );
        return view('pages/services')->with($data);
    }
}
