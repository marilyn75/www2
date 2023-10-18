<?php

namespace App\Http\Controllers\Web;

use App\Http\Class\MenuClass;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class PageController extends Controller
{
    public function index($id){
        $page = Menu::find($id);
        $MenuClass = new MenuClass;
        $arrLocation = $MenuClass->getLocationArr($id);
        $bg = $MenuClass->getTopImage($id);
        

        return view('web.page', compact('page', 'arrLocation', 'bg'));
    }

    public function view(){
        
    }
}
