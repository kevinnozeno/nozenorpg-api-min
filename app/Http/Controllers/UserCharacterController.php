<?php

namespace App\Http\Controllers;

use App\Http\Helpers\UserCharacterHelper;
use App\Http\Requests\UserCharacter\StoreUserCharacterRequest;
use App\Http\Requests\UserCharacter\UpdateUserCharacterRequest;
use App\Http\Requests\UserCharacter\UserCharacterJoinRequest;
use App\Http\Requests\UserCharacter\UserCharacterUpdateInRoomRequest;
use App\Models\Character;
use App\Models\Room;
use App\Models\Roomable;
use App\Models\User;
use App\Models\UserCharacter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
     * @param StoreUserCharacterRequest $request
     * @return JsonResponse
     */
    public function store(User $user, Character $character, StoreUserCharacterRequest $request): JsonResponse
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
            ->with('rooms', 'skills')
            ->where('character_id', $character->id)
            ->first();

        return response()->json($characterUser);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param User $user
     * @param Character $character
     * @param UpdateUserCharacterRequest $request
     * @return JsonResponse
     */
    public function update(User $user, Character $character, UpdateUserCharacterRequest $request): JsonResponse
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
    public function destroy(User $user, Character $character): JsonResponse
    {
        return response()->json($user->characters()->detach($character->id));
    }

    public function join(UserCharacter $userCharacter, Room $room, UserCharacterJoinRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $validated['statistics']['actualPv'] = $this->actualPvValidation($validated['statistics']['actualPv'], $userCharacter);
        $userCharacter->rooms()->attach($room->id, $validated);
        return response()->json($validated);
    }

    public function updateInRoom(UserCharacter $userCharacter, Room $room, UserCharacterUpdateInRoomRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $validated['statistics']['actualPv'] = UserCharacterHelper::actualPvValidation($validated['statistics']['actualPv'], $userCharacter->character->pv);
        $userCharacter->rooms()->updateExistingPivot($room->id, $validated);
        return response()->json($validated);
    }

    public function leave(UserCharacter $userCharacter, Room $room): JsonResponse
    {
        return response()->json($userCharacter->rooms()->detach($room->id));
    }
}
