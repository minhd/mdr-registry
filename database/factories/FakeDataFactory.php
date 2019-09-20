<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(App\DataSource::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'user_id' => factory(App\User::class)->create()->id
    ];
});

$factory->define(App\Record::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'data_source_id' => factory(App\DataSource::class)->create()->id
    ];
});

$factory->define(App\Schema::class, function (Faker $faker) {
    return [
        'schema_id' => $faker->uuid,
        'title' => $faker->name,
        'format' => $faker->randomElement(['application/json', 'application/xml', 'text/plain']),
        'description' => $faker->paragraph,
        'user_id' => factory(App\User::class)->create()->id
    ];
});

$factory->define(App\Version::class, function (Faker $faker) {
    return [
        'schema_id' => factory(App\Schema::class)->create()->schema_id,
        'record_id' => factory(App\Record::class)->create()->id,
        'status' => 'CURRENT',
        'data' => $faker->paragraph
    ];
});
