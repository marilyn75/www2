<?php

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use Illuminate\Http\Request;

class PusherController extends Controller
{
    public function index()
    {
        return view('message.index');
    }

    public function broadcast(Request $request)
    {
        broadcast(new PusherBroadcast($request->get('message')))->toOthers();

        return view('message.broadcast', ['message' => $request->get('message')]);
    }

    public function receive(Request $request)
    {
        return view('message.receive', ['message' => $request->get('message')]);
    }
}
