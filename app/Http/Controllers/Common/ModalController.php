<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModalController extends Controller
{
    public function content($path, Request $request){

        $data = $request->all();

        return view($path, compact('data'))->render();
        // return response()->json(['html' => $content]);
    }
}
