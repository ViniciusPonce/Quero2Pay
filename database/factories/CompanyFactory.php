<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;

$factory->define(\App\Models\Company::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'cep' => $faker->postcode,
        'rua' => $faker->streetName,
        'bairro' => $faker->firstName,
        'cidade' => $faker->country,
        'estado' => $faker->state,
        'ibge' => $faker->randomNumber(6),
        'numero' => $faker->randomNumber(4),
        'complemento' => 'Nenhum Complemento',
        'telefone' => $faker->phoneNumber
    ];
});
