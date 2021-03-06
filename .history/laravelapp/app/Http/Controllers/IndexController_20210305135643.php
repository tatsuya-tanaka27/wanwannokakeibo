<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        echo "test";
        return view('kakeibo.index');
    }

    public function post(Request $request)
    {

    }
}
