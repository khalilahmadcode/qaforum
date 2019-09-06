<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Question; 

$factory->define(Question::class, function (Faker $faker) {
    return [
        'title'=> rtrim($faker->sentence(rand(5, 10), ".")), 
        'body'=> $faker->paragraphs(rand(3, 5), true), 
        'views'=> rand(0, 10), 
        'answers_count'=> rand(0, 19),
        'votes'=> rand(-3, 10) 
    ];
});
