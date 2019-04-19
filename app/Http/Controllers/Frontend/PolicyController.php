<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

/**
 * Class PolicyController
 * @package App\Http\Controllers\Frontend
 */
class PolicyController extends Controller
{
    public function policy()
    {
        return view('frontend.policy.policy');
    }

    public function disclaimer()
    {
        return view('frontend.policy.disclaimer');
    }
}