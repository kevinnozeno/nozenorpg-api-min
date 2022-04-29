<?php

namespace App\Http\Controllers;

use App\Events\NewAction;
use App\Http\Requests\UserCharacter\DestroyUserCharacterRequest;
use App\Http\Requests\UserCharacter\StoreUserCharacterRequest;
use App\Http\Requests\UserCharacter\UpdateUserCharacterRequest;
use App\Models\Character;
use App\Models\Entity;
use App\Models\Room;
use App\Models\User;
use App\Models\UserCharacter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserCharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function index(User $user): JsonResponse
    {
        return response()->json(UserCharacter::where('user_id', $user->id)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserCharacterRequest $request
     * @return JsonResponse
     */
    public function store(StoreUserCharacterRequest $request): JsonResponse
    {
        $validated = $request->validated();
        foreach ($validated['users'] as $user) {
            (User::find($user))->characters()->attach($validated['characters'], [
                'level' => $validated['level'],
                'pv_modif' => $validated['pv_modif']
            ]);
        }
        return response()->json($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @param Character $character
     * @return JsonResponse
     */
    public function show(User $user, Character $character): JsonResponse
    {
        $characterUser = UserCharacter::where('user_id', $user->id)
            ->where('character_id', $character->id)
            ->first();

        return response()->json($characterUser);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserCharacterRequest $request
     * @return JsonResponse
     */
    public function update(UpdateUserCharacterRequest $request): JsonResponse
    {
        $validated = $request->validated();
        foreach ($validated['users'] as $user) {
            (User::find($user))->characters()->updateExistingPivot($validated['characters'], [
                'level' => $validated['level'],
                'pv_modif' => $validated['pv_modif']
            ]);
        }
        return response()->json($validated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyUserCharacterRequest $request
     * @return JsonResponse
     */
    public function destroy(DestroyUserCharacterRequest $request): JsonResponse
    {
        $validated = $request->validated();
        foreach ($validated['users'] as $user) {
            (User::find($user))->characters()->detach($validated['characters']);
        }
        return response()->json($validated);
    }

    public function attack(Request $request): JsonResponse
    {
        $userCharacter = UserCharacter::find($request->user);
        $target = (Entity::find($request->target_type))->model::find($request->target_id);

        $target->pv_modif -= $userCharacter->character->ad;
        $target->update();

        event(new NewAction('channel', 'attack', $target));
        return response()->json($target, 200);
    }

    public function cast(Request $request): JsonResponse
    {
        $userCharacter = UserCharacter::find($request->user);
        $target = (Entity::find($request->target_type))->model::find($request->target_id);

        $target->pv_modif -= $userCharacter->character->ap;
        $target->update();

        event(new NewAction('channel', 'cast', $target));
        return response()->json($target, 200);
    }

    public function heal(Request $request): JsonResponse
    {
        $userCharacter = UserCharacter::find($request->user);
        $target = (Entity::find($request->target_type))->model::find($request->target_id);

        $target->pv_modif += $userCharacter->character->heal;
        $target->update();

        event(new NewAction('channel', 'heal', $target));
        return response()->json($target, 200);
    }

    public function attachRoom(User $user, Character $character, Request $request) {

    }
}
