<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Rewrite;

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
        return view('front.' . class_basename($rewrite->entity), [
            'rewrite' => $rewrite,
            'entity' => $rewrite->entity,
        ]);
    }
}
