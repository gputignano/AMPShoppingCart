<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Rewrite;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $rewrites = Rewrite::all();

        return view('front.home', compact('rewrites'));
    }
}
