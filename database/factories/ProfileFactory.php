<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        //
        'first_name'=> $faker->firstName,
        'last_name'=>$faker->lastName,
        'email'=>$faker->unique()->email,
         'address'=>$faker->address
        
    ];
});
