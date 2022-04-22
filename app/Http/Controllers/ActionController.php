<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Events\NewAction;
use Illuminate\Support\Facades\Auth;

class ActionController extends Controller
{
    public function attack(Character $character, User $user, Request $request): JsonResponse
    {
        $characterUser = ((new CharacterController())->showOfUser($character, $user))->getData();

        $targetUser = Character::query()
            ->where('id', $request->target['id'])
            ->with(['users' => function ($query) use ($request) {
                $query->where('id', $request->target['user_id']);
            }])
            ->first();

        $new_pv_modif = $targetUser->users[0]->pivot->pv_modif - $characterUser->ad;

        Character::find($targetUser->id)->users()->updateExistingPivot($targetUser->users[0]->pivot['user_id'], [
            'pv_modif' => $new_pv_modif
        ]);

        $targetUser = ((new CharacterController())->showOfUser(Character::find($request->target['id']), User::find($request->target['user_id'])))->getData();

        event(new NewAction($targetUser));
        return response()->json($targetUser, 200);
    }

    public function cast(Character $character, User $user, Request $request): JsonResponse
    {
        $characterUser = ((new CharacterController())->showOfUser($character, $user))->getData();

        $targetUser = Character::query()
            ->where('id', $request->target['id'])
            ->with(['users' => function ($query) use ($request) {
                $query->where('id', $request->target['user_id']);
            }])
            ->first();

        $new_pv_modif = $targetUser->users[0]->pivot->pv_modif - $characterUser->ap;

        Character::find($targetUser->id)->users()->updateExistingPivot($targetUser->users[0]->pivot['user_id'], [
            'pv_modif' => $new_pv_modif
        ]);

        $targetUser = ((new CharacterController())->showOfUser(Character::find($request->target['id']), User::find($request->target['user_id'])))->getData();

        event(new NewAction($targetUser));
        return response()->json($targetUser, 200);
    }

    public function heal(Character $character, User $user, Request $request): JsonResponse
    {
        $characterUser = ((new CharacterController())->showOfUser($character, $user))->getData();

        $targetUser = Character::query()
            ->where('id', $request->target['id'])
            ->with(['users' => function ($query) use ($request) {
                $query->where('id', $request->target['user_id']);
            }])
            ->first();

        $new_pv_modif = $targetUser->users[0]->pivot->pv_modif + $characterUser->heal;

        Character::find($targetUser->id)->users()->updateExistingPivot($targetUser->users[0]->pivot['user_id'], [
            'pv_modif' => $new_pv_modif
        ]);

        $targetUser = ((new CharacterController())->showOfUser(Character::find($request->target['id']), User::find($request->target['user_id'])))->getData();

        event(new NewAction($targetUser));
        return response()->json($targetUser, 200);
    }
}
