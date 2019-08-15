<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Comments::class, function (Faker $faker) {
    return [
        'commenter' => $faker->lastName,
        'body'      => $faker->text,
        'posts_id'  => function () {
            return factory(\App\Models\Posts::class)->create()->id;
        },
    ];
});
