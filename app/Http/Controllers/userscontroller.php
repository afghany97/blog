<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userscontroller extends Controller
{
    public function logout()
    {
        \Auth::logout();
        return back();
    }
}
