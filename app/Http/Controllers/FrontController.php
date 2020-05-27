<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Rewrite;
use Illuminate\Support\Facades\Request;

class FrontController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function home(Request $request)
    {
        $products = Product::has('rewrite')->get();

        return view('front.home', compact('products'));
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function front(Rewrite $rewrite)
    {
        return view('front.' . basename($rewrite->entity->type), [
            'rewrite' => $rewrite,
            'entity' => $rewrite->entity,
        ]);
    }
}
