<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Registry\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(App\Registry\Models\DataSource::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'user_id' => factory(App\Registry\Models\User::class)->create()->id
    ];
});

$factory->define(App\Registry\Models\Record::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'data_source_id' => factory(App\Registry\Models\DataSource::class)->create()->id
    ];
});

$factory->define(App\Registry\Models\Schema::class, function (Faker $faker) {
    return [
        'schema_id' => $faker->uuid,
        'title' => $faker->name,
        'format' => $faker->randomElement(['application/json', 'application/xml', 'text/plain']),
        'description' => $faker->paragraph,
        'user_id' => factory(App\Registry\Models\User::class)->create()->id
    ];
});

$factory->define(App\Registry\Models\Version::class, function (Faker $faker) {
    return [
        'schema_id' => factory(App\Registry\Models\Schema::class)->create()->schema_id,
        'record_id' => factory(App\Registry\Models\Record::class)->create()->id,
        'status' => 'CURRENT',
        'data' => $faker->paragraph
    ];
});
