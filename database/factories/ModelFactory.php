<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});

$factory->define(App\Models\Product::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
        'price' => $faker->randomFloat(3),
    ];
});

$factory->define(App\Models\Client::class, function (Faker\Generator $faker) {
    return [
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'city' => $faker->city,
        'state' => $faker->state,
        'zipcode' => $faker->postcode,
    ];
});

$factory->define(App\Models\Order::class, function (Faker\Generator $faker) {
    return [
        'client_id' => rand(1,10),
        'total' => rand(50,150),
        'status' => 0,
    ];
});

$factory->define(App\Models\OrderItem::class, function (Faker\Generator $faker) {
    return [
    ];
});

$factory->define(App\Models\Cupom::class, function (Faker\Generator $faker) {
    return [
        'code' => rand(100, 1000),
        'value' => rand(50, 100)
    ];
});
