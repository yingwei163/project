<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RageController extends Controller
{
    //
    public function rage()
    {
        return view('home\Cartoon\RageComic');
    }
}
