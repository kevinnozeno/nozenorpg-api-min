<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Skillable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SkillableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Skill $skill
     * @param $skillable_type
     * @return JsonResponse
     */
    public function index(Skill $skill, $skillable_type): JsonResponse
    {
        $skillable_type = $skillable_type === 'userCharacters' ? 'userCharacter' : $skillable_type;
        $skillable_type = $skillable_type === 'characters' ? 'character' : $skillable_type;

        return response()->json(Skillable::where('skill_id', $skill->id)
            ->where('skillable_type', $skillable_type)
            ->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Skill $skill, $skillable_type, $skillable_id): JsonResponse
    {
        if ($skillable_type === 'characters') {
            $skill->characters()->attach($skillable_id);
        } elseif ($skillable_type === 'userCharacters') {
            $skill->user_characters()->attach($skillable_id);
        }

        return response()->json($skill);
    }

    /**
     * Display the specified resource.
     *
     * @param Skill $skill
     * @param $skillable_type
     * @param $skillable_id
     * @return JsonResponse
     */
    public function show(Skill $skill, $skillable_type, $skillable_id): JsonResponse
    {
        $skillable_type = $skillable_type === 'userCharacters' ? 'userCharacter' : $skillable_type;
        $skillable_type = $skillable_type === 'characters' ? 'character' : $skillable_type;

        return response()->json(Skillable::where('skill_id', $skill->id)
            ->where('skillable_type', $skillable_type)
            ->where('skillable_id', $skillable_id)
            ->first()
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Skill $skill, $skillable_type, $skillable_id, Request $request): JsonResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Skill $skill
     * @param $skillable_type
     * @param $skillable_id
     * @return JsonResponse
     */
    public function destroy(Skill $skill, $skillable_type, $skillable_id): JsonResponse
    {
        if ($skillable_type === 'characters') {
            $skill->characters()->detach($skillable_id);
        } elseif ($skillable_type === 'userCharacters') {
            $skill->user_characters()->detach($skillable_id);
        }

        return response()->json($skill);
    }
}
