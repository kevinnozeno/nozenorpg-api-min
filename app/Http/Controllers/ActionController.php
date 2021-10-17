<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NewAction;

class ActionController extends Controller
{
    public function attack()
    {
        $damage = 5;
        event(new NewAction($damage));
        return response($damage, 200);
    }
}
