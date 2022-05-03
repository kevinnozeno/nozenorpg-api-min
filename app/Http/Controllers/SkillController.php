<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\User;
use App\Models\UserCharacter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Events\NewAction;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
//    public function use (Roomable $roomable, Skill $skill, Request $request): JsonResponse
//    {
//        $controller = $entity->controller;
//        $method = $action->method;
//        return response()->json((new $controller)->$method($request));
//    }
//
//    public function attack(Request $request): JsonResponse
//    {
//        $userCharacter = UserCharacter::find($request->user_id);
//        $target = (Entity::find($request->target_type))->model::find($request->target_id);
//
//        $target->pv_modif -= $userCharacter->character->ad;
//        $target->update();
//
//        event(new NewAction('channel', 'attack', $target));
//        return response()->json($target, 200);
//    }
//
//    public function cast(Request $request): JsonResponse
//    {
//        $userCharacter = UserCharacter::find($request->user_id);
//        $target = (Entity::find($request->target_type))->model::find($request->target_id);
//
//        $target->pv_modif -= $userCharacter->character->ap;
//        $target->update();
//
//        event(new NewAction('channel', 'cast', $target));
//        return response()->json($target, 200);
//    }
//
//    public function heal(Request $request): JsonResponse
//    {
//        $userCharacter = UserCharacter::find($request->user_id);
//        $target = (Entity::find($request->target_type))->model::find($request->target_id);
//
//        $target->pv_modif += $userCharacter->character->heal;
//        $target->pv_modif = $target->pv_modif > 0 ? 0 : $target->pv_modif;
//        $target->update();
//
//        event(new NewAction('channel', 'heal', $target));
//        return response()->json($target, 200);
//    }
}
