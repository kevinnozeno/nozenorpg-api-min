<?php

namespace App\Http\Controllers;

use App\Models\Roomable;
use Illuminate\Database\Eloquent\Relations\Relation;
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
     */
    public function store()
    {
        //
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
    public function update()
    {
        //
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
}
