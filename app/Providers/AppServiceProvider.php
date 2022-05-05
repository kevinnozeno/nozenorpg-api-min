<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Relation::morphMap([
            'user' => 'App\Models\User',
            'character' => 'App\Models\Character',
            'userCharacter' => 'App\Models\UserCharacter',
            'room' => 'App\Models\Room',
            'roomable' => 'App\Models\Roomable',
            'skill' => 'App\Models\Skill',
            'skillable' => 'App\Models\Skillable',
        ]);
    }
}
