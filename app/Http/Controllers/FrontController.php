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
    public function __invoke(Rewrite $rewrite)
    {
        return view('front.' . basename($rewrite->entity->type, 'App\\Models\\'), [
            'rewrite' => $rewrite,
            'entity' => $rewrite->entity,
        ]);
    }
}
