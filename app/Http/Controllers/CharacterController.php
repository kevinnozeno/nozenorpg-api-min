<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Character $character
     * @param User $user
     * @return JsonResponse
     */
    public function showOfUser(Character $character, User $user): JsonResponse
    {
        $characterUser = Character::query()
            ->where('id', $character->id)
            ->with(['users' => function ($query) use ($user) {
                $query->where('id', $user->id);
            }])
            ->first();

        $character->actual_pv = $characterUser->pv + $characterUser->users[0]->pivot->pv_modif;
        $character->level = $characterUser->users[0]->pivot->level;

        return response()->json($character);
    }
}
