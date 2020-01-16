<?php

namespace App\Http\Controllers\Admin;
use App\Base;
use Auth;
use Session;

use Illuminate\Http\Request;

class HomeController
{
    public function index()
    {

        return view('home');
    }
}
