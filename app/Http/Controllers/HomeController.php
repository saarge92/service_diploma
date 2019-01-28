<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\HomeTrait;
use Illuminate\View\View;

class HomeController extends Controller
{
    use HomeTrait;

    public function index() : View
    {
        $data = $this->dataForIndexPage();
        return view('frontend.index', $data);
    }
}
