<?php

namespace App\Http\Controllers;

use App\Http\Requests\Roomable\StoreRoomableRequest;
use App\Http\Requests\Roomable\UpdateRoomableRequest;
use App\Http\Traits\SkillTrait;
use App\Models\Room;
use App\Models\Roomable;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoomableController extends Controller
{
    use SkillTrait;

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Roomable::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomableRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $room = Room::find($validated['room_id']);

        $lastPlayer = Roomable::where('room_id', $validated['room_id'])
            ->orderBy('statistics->order', 'desc')
            ->first();

        $userCharacter = (new (Relation::getMorphedModel($validated['roomable_type'])))->find($validated['roomable_id']);

        $statistics = $lastPlayer?->statistics;

        if ($validated['roomable_type'] === 'userCharacter') {
            $statistics = [
                'order' => $statistics ? $statistics['order'] + 1 : 1,
                'playing' => false,
                'actualPv' => $userCharacter->character->pv
            ];
            $room->user_characters()->attach($validated['roomable_id'], [
                'statistics' => json_decode(json_encode($statistics)),
                'is_active' => false
            ]);
        }
        return response()->json($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param Roomable $roomable
     * @return JsonResponse
     */
    public function show(Roomable $roomable): JsonResponse
    {
        return response()->json($roomable);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Roomable $roomable, UpdateRoomableRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $room = Room::find($roomable->room_id);

        if ($roomable->roomable_type === 'userCharacter') {
            $statistics = [
                'order' => $validated['statistics']['order'],
                'playing' => $validated['statistics']['playing'],
                'actualPv' => $validated['statistics']['actualPv']
            ];
            $room->user_characters()->updateExistingPivot($roomable->roomable_id, [
                'statistics' => json_decode(json_encode($statistics)),
                'is_active' => $validated['is_active']
            ]);
        }
        return response()->json($validated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        return response()->json(Roomable::destroy($id));
    }

    public function use (Roomable $roomable, string $skill, Request $request): JsonResponse
    {
        $method = Str::camel($skill);
        return response()->json($this->$method($roomable, $request));
    }
}
