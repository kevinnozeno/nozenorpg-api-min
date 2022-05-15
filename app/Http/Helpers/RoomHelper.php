<?php

namespace App\Http\Helpers;

use App\Models\Roomable;
use Illuminate\Database\Eloquent\Relations\Relation;

class RoomHelper
{
    public function __construct($roomId)
    {
        $this->roomId = $roomId;
    }

    public function nextTurn (): array
    {
        // UPDATE ROOMABLE PLAYING STATUS
        $roomablePlaying = Roomable::where('room_id', $this->roomId)->where('statistics->playing', true)->first();

        $roomablePlayingStatistics = $roomablePlaying->statistics;
        $newOrder = intval($roomablePlayingStatistics['order']) + 1;
        $roomablePlayingStatistics['playing'] = false;
        $roomablePlaying->statistics = $roomablePlayingStatistics;
        $roomablePlaying->update();


        // UPDATE NEXT ROOMABLE PLAYING STATUS
        $nextRoomable = Roomable::where('room_id', $this->roomId)
            ->where('statistics->order', $newOrder)->first();
        if (!$nextRoomable) {
            $nextRoomable = Roomable::where('room_id', $this->roomId)
                ->where('statistics->order', 1)->first();
        }

        $nextRoomableStatistics = $nextRoomable->statistics;
        $nextRoomableStatistics['playing'] = true;
        $nextRoomable->statistics = $nextRoomableStatistics;
        $nextRoomable->update();

        $model = Relation::getMorphedModel($nextRoomable->roomable_type);
        $nextEntity = $model::find($nextRoomable->roomable_id);

        return [
            "title" => "Tour",
            "subtitle" => "Joueur suivant",
            "message" => "C'est au tour de " . $nextEntity->name,
        ];
    }
}
