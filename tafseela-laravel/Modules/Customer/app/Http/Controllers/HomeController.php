<?php

namespace Modules\Customer\Http\Controllers;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('customer::home');
    }
}
