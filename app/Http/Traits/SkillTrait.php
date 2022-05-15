<?php

namespace App\Http\Traits;

use App\Events\NewAction;
use App\Http\Helpers\RoomHelper;
use App\Http\Helpers\UserCharacterHelper;
use App\Models\Room;
use App\Models\Roomable;
use App\Models\UserCharacter;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

trait SkillTrait
{
    public function attack(Roomable $roomable, Request $request): JsonResponse
    {
        $model = Relation::getMorphedModel($roomable->roomable_type);
        $user = $model::find($roomable->roomable_id);
        $target = Roomable::find($request->target);

        $statistics = $target->statistics;

        if ($target->roomable_type === 'userCharacter') {
            $userCharacter = UserCharacter::find($target->roomable_id);
            $statistics['actualPv'] -= $user->character->ad;
            $statistics['actualPv'] = UserCharacterHelper::actualPvValidation($statistics['actualPv'], $userCharacter->character->pv);
        }

        $target->statistics = $statistics;
        $target->update();

        $nextTurnResponse = (new RoomHelper($roomable->room_id))->nextTurn();

        $room = Room::with('user_characters')->find($roomable->room_id);

        $modelTarget = Relation::getMorphedModel($target->roomable_type);
        $target = $modelTarget::find($target->roomable_id);

        $messages = [
            [
                "title" => "Action : Attaquer",
                "message" => $user->name . " a attaqué " . $target->name . " en lui infligeant " . $user->character->ad . " de dégats AD.",
            ],
            $nextTurnResponse
        ];

        event(new NewAction($room, $messages));
        return response()->json(["room" => $room, "messages" => $messages], 200);
    }

    public function cast(Roomable $roomable, Request $request): JsonResponse
    {
        $model = Relation::getMorphedModel($roomable->roomable_type);
        $user = $model::find($roomable->roomable_id);
        $target = Roomable::find($request->target);

        $statistics = $target->statistics;

        if ($target->roomable_type === 'userCharacter') {
            $userCharacter = UserCharacter::find($target->roomable_id);
            $statistics['actualPv'] -= $user->character->ap;
            $statistics['actualPv'] = UserCharacterHelper::actualPvValidation($statistics['actualPv'], $userCharacter->character->pv);
        }

        $target->statistics = $statistics;
        $target->update();

        $nextTurnResponse = (new RoomHelper($roomable->room_id))->nextTurn();

        $room = Room::with('user_characters')->find($roomable->room_id);

        $modelTarget = Relation::getMorphedModel($target->roomable_type);
        $target = $modelTarget::find($target->roomable_id);

        $messages = [
            [
                "title" => "Action : Ensorceller",
                "message" => $user->name . " a ensorcellé " . $target->name . " en lui infligeant " . $user->character->ap . " de dégats AP.",
            ],
            $nextTurnResponse
        ];

        event(new NewAction($room, $messages));
        return response()->json(["room" => $room, "messages" => $messages], 200);
    }

    public function heal(Roomable $roomable): JsonResponse
    {
        $model = Relation::getMorphedModel($roomable->roomable_type);
        $user = $model::find($roomable->roomable_id);
        $target = Roomable::find($roomable->id);

        $statistics = $target->statistics;

        if ($target->roomable_type === 'userCharacter') {
            $userCharacter = UserCharacter::find($target->roomable_id);
            $statistics['actualPv'] += $user->character->heal;
            $statistics['actualPv'] = UserCharacterHelper::actualPvValidation($statistics['actualPv'], $userCharacter->character->pv);
        }

        $target->statistics = $statistics;
        $target->update();

        $nextTurnResponse = (new RoomHelper($roomable->room_id))->nextTurn();

        $room = Room::with('user_characters')->find($roomable->room_id);

        $messages = [
            [
                "title" => "Action : Soigner",
                "message" => $user->name . " s'est soigné de " . $user->character->heal . " PV.",
            ],
            $nextTurnResponse
        ];

        event(new NewAction($room, $messages));
        return response()->json(["room" => $room, "messages" => $messages], 200);
    }
}
