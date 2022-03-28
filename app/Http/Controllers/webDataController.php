<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App;

class webDataController extends Controller
{
    public function english()
    {
        Session::put('locale', 'en');
        App::setlocale('en');
        return back();
    }

    public function dari()
    {
        Session::put('locale', 'fa');
        App::setlocale('fa');
        return back();
    }

    public function pashto()
    {
        Session::put('locale', 'pa');
        App::setlocale('pa');
        return back();
    }
}
