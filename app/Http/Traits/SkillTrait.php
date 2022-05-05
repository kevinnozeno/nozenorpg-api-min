<?php

namespace App\Http\Traits;

use App\Events\NewAction;
use App\Http\Helpers\UserCharacterHelper;
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

        event(new NewAction('room-'.$roomable->room_id, 'attack', $target));
        return response()->json($target, 200);
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

        event(new NewAction('room-'.$roomable->room_id, 'cast', $target));
        return response()->json($target, 200);
    }

    public function heal(Roomable $roomable): JsonResponse
    {
        $model = Relation::getMorphedModel($roomable->roomable_type);
        $user = $model::find($roomable->roomable_id);
        $target = Roomable::find($roomable->roomable_id);

        $statistics = $target->statistics;

        if ($target->roomable_type === 'userCharacter') {
            $userCharacter = UserCharacter::find($target->roomable_id);
            $statistics['actualPv'] += $user->character->heal;
            $statistics['actualPv'] = UserCharacterHelper::actualPvValidation($statistics['actualPv'], $userCharacter->character->pv);
        }

        $target->statistics = $statistics;

        $target->update();

        event(new NewAction('room-'.$roomable->room_id, 'heal', $target));
        return response()->json($target, 200);
    }
}
