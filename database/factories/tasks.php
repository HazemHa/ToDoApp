<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        //
        'content' => $faker->name,
        'isDone' => $faker->boolean,
        'user_id'=> \App\User::find(1)->id

    ];
});
