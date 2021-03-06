<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kakeibo_user;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        return view('kakeibo.login');
    }

    public function post(Request $request)
    {
        $name = $request->name;
        $items = DB::table('people')
        ->where('name', 'like', '%' . $name . '%')
        ->orWhere('mail', 'like', '%' . $name . '%')
        ->get();
        return view('hello.show', ['items' => $items]);
        return view('kakeibo.index');
    }

}
