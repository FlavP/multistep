<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Client;

$factory->define(Client::class, function (Faker $faker) {
    $age = rand(12, 89);
    $marriable = isMarried($age);
    $married = $marriable == true ? $faker->boolean : false;
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'age'  => $age,
        'married' => $married,
        'partner' => $married == true ? $faker->name : null,
    ];
});

function isMarried($age) {
    if ($age > 18)
        return true;
    return false;
}
