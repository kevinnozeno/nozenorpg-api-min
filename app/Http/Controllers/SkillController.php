<?php

namespace App\Http\Controllers;

use App\Http\Requests\Room\StoreRoomRequest;
use App\Http\Requests\Skill\StoreSkillRequest;
use App\Http\Requests\Skill\UpdateSkillRequest;
use App\Models\Skill;
use Illuminate\Http\JsonResponse;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Skill::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSkillRequest $request
     * @return JsonResponse
     */
    public function store(StoreSkillRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $room = new Skill($validated);
        return response()->json($room->save());
    }

    /**
     * Display the specified resource.
     *
     * @param Skill $skill
     * @return JsonResponse
     */
    public function show(Skill $skill): JsonResponse
    {
        return response()->json($skill);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSkillRequest $request
     * @param Skill $skill
     * @return JsonResponse
     */
    public function update(UpdateSkillRequest $request, Skill $skill): JsonResponse
    {
        $validated = $request->validated();
        return response()->json($skill->update($validated));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        return response()->json(Skill::destroy($id));
    }
}
