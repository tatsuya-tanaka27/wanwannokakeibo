<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        return view('kakeibo.login');
    }

    public function post(Request $request)
    {
        return view('kakeibo.index');
    }

}
