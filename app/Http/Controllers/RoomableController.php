<?php

namespace App\Http\Controllers;

use App\Http\Requests\Room\StoreRoomRequest;
use App\Http\Requests\Room\UpdateRoomRequest;
use App\Models\Roomable;
use http\Env\Request;
use Illuminate\Http\JsonResponse;

class RoomableController extends Controller
{
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
     *
     * @param StoreRoomRequest $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
//        $validated = $request->validated();
//        $room = new Room($validated);
//        return response()->json($room->save());
    }

    /**
     * Display the specified resource.
     *
     * @param Room $room
     * @return JsonResponse
     */
    public function show(Request $room): JsonResponse
    {
//        return response()->json($room);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRoomRequest $request
     * @param Room $room
     * @return JsonResponse
     */
    public function update(Request $request, Room $room): JsonResponse
    {
//        $validated = $request->validated();
//        return response()->json($room->update($validated));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
//        return response()->json(Room::destroy($id));
    }
}
