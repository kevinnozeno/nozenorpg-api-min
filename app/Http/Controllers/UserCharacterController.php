<?php

namespace App\Http\Controllers;

use App\Events\NewAction;
use App\Http\Requests\UserCharacter\DestroyUserCharacterRequest;
use App\Http\Requests\UserCharacter\AttachUserCharacterRequest;
use App\Http\Requests\UserCharacter\SyncUserCharacterRequest;
use App\Models\Character;
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
     * @param User $user
     * @param Character $character
     * @param AttachUserCharacterRequest $request
     * @return JsonResponse
     */
    public function attach(User $user, Character $character, AttachUserCharacterRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $user->characters()->attach($character->id, [
            'name' => $validated['name'],
            'level' => $validated['level']
        ]);
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
     * @param User $user
     * @param Character $character
     * @param SyncUserCharacterRequest $request
     * @return JsonResponse
     */
    public function sync(User $user, Character $character, SyncUserCharacterRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $user->characters()->updateExistingPivot($character->id, [
            'name' => $validated['name'],
            'level' => $validated['level'],
        ]);
        return response()->json($validated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @param Character $character
     * @return JsonResponse
     */
    public function detach(User $user, Character $character): JsonResponse
    {
        return response()->json($user->characters()->detach($character->id));
    }

//    public function join(Request $request): JsonResponse
//    {
//        $entity = Entity::where('controller', get_class($this))->first();
//        $entitiesable = Entitiesable::where('entity_id', $entity->id)
//            ->where('entitiesable_id', $request->user_id)
//            ->where('entitiesable_type', 'user_character')
//            ->first();
//
//        $lastPlayer = EntitiesableRoom::select('order')->where('room_id', $request->room_id)->orderBy('order', 'DESC')->first();
//
//        return response()->json($entitiesable->rooms()->attach($request->room_id, [
//            'order' => $lastPlayer->order++,
//            'playing' => 0
//        ]));
//    }
//
//    public function leave(Request $request): JsonResponse
//    {
//        $userCharacter = UserCharacter::find($request->user_id);
//        return response()->json($userCharacter->rooms()->detach($request->room_id));
//    }
}
