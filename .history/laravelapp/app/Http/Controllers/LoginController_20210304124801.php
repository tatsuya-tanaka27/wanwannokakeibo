<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        return view('kakeibo.index');
    }

    public function post(Request $request)
    {

    }
}