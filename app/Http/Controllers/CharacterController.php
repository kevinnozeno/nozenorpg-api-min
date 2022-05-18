<?php

namespace App\Http\Controllers;

use App\Http\Requests\Character\StoreCharacterRequest;
use App\Http\Requests\Character\UpdateCharacterRequest;
use App\Models\Character;
use Illuminate\Http\JsonResponse;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Character::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCharacterRequest $request
     * @return JsonResponse
     */
    public function store(StoreCharacterRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $character = new Character($validated);
        return response()->json($character->save());
    }

    /**
     * Display the specified resource.
     *
     * @param Character $character
     * @return JsonResponse
     */
    public function show(Character $character): JsonResponse
    {
        return response()->json($character);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCharacterRequest $request
     * @param Character $character
     * @return JsonResponse
     */
    public function update(UpdateCharacterRequest $request, Character $character): JsonResponse
    {
        $validated = $request->validated();
        return response()->json($character->update($validated));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        return response()->json(Character::destroy($id));
    }
}
