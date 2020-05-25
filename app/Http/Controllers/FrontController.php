<?php

namespace App\Http\Controllers;

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
        return view('front.' . basename($rewrite->entity->type), [
            'rewrite' => $rewrite,
            'entity' => $rewrite->entity->type::find($rewrite->id),
        ]);
    }
}
