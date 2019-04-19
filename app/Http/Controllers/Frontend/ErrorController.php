<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

/**
 * Class ErrorController
 * @package App\Http\Controllers\Frontend
 */
class ErrorController extends Controller
{
    public function get404()
    {
        return view('frontend.errors.404');
    }
}
