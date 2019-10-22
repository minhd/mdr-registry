<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

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

$factory->define(App\Registry\Models\Version::class, function (Faker $faker) {
    return [
        'schema' => 'rifcs',
        'record_id' => factory(App\Registry\Models\Record::class)->create()->id,
        'status' => 'CURRENT',
        'data' => $faker->paragraph
    ];
});

$factory->define(App\Registry\Models\Identifier::class, function (Faker $faker) {
    return [
        'type' => $faker->word,
        'value' => $faker->sentence
    ];
});

$factory->define(App\IGSN\Models\IGSNClient::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\Registry\Models\User::class)->create()->id,
        'data_source_id' => factory(App\Registry\Models\DataSource::class)->create()->id
    ];
});

$factory->define(App\IGSN\Models\IGSN::class, function (Faker $faker) {
    return [
        'client_id' => factory(App\IGSN\Models\IGSNClient::class)->create()->id,
        'igsn' => $faker->uuid
    ];
});

$factory->define(App\IGSN\Models\IGSNPrefix::class, function (Faker $faker) {
    return [
        'prefix' => $faker->word
    ];
});

$factory->define(App\Registry\Models\Import::class, function (Faker $faker) {
    return [
        'data_source_id' => factory(App\Registry\Models\DataSource::class)->create()->id,
        'status' => 'PENDING',
        'params' => [],
        'info' => []
    ];
});
