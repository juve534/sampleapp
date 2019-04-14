<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Comments::class, function (Faker $faker) {
    return [
        'commenter' => $faker->kanaName(),
        'body'  => $faker->text,
        'post_id' => function() {
            return factory(\App\Models\Posts::class)->create()->id;
        }
    ];
});
