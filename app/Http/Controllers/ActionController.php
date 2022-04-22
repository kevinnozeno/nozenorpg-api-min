<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;
use App\Events\NewAction;

class ActionController extends Controller
{
    public function attack(Request $request)
    {
        $target = Character::findOrFail($request->target);
        $target->pv -= $request->damage;
        $target->save();

        event(new NewAction($target));
        return response($request->damage, 200);
    }
}
