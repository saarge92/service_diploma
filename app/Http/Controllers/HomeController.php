<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where(['is_on_main' => true])->get();
        return view('frontend.index', ['sliders' => $sliders]);
    }
}
