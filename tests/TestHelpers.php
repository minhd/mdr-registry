<?php

function create($class, array $attributes = [], int $count = 1)
{
    if ($count === 1) {
        return factory($class)->create($attributes);
    }

    $results = [];
    for ($i = 0; $i < $count; $i++) {
        $results[] = factory($class)->create($attributes);
    }

    return collect($results);
}

function signIn($user = null)
{
    if ($user === null) {
        $user = factory(App\Registry\Models\User::class)->create();
    }
    Laravel\Passport\Passport::actingAs($user);
    return $user;
}

//function signInAdmin()
//{
//    $user = factory(App\User::class)->create();
//    $user->addRole('admin');
//    Laravel\Passport\Passport::actingAs($user);
//}
