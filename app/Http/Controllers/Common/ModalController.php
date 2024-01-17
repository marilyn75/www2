<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModalController extends Controller
{
    public function content($path){
        return view($path)->render();
        // return response()->json(['html' => $content]);
    }
}
