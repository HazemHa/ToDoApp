<?php
use App\User\Model\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
/*
|
--------------------------------------------------------------------------
| Model Factories
|
-------------------------------------------------------------------------
|
| This directory should contain each of the model 
factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your 
application's database.
|
*/
$factory->define(App\Shareable\Model\Shareable::class, function (Faker $faker){
return [
undefined,
undefined,
'shareable_user_id' => function () {
return App\Shareable\Model\Shareable::inRandomOrder()->first()->id;

}];
});
