<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Character;
use App\Models\Entity;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Events\NewAction;
use Illuminate\Support\Facades\Auth;

class ActionController extends Controller
{
    public function use (Entity $entity, Action $action, Request $request): JsonResponse
    {
        $controller = $entity->controller;
        $method = $action->method;
        return response()->json((new $controller)->$method($request));
    }
}
