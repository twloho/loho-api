<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Association\Member::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\zh_TW\Address($faker));
    $faker->addProvider(new Faker\Provider\zh_TW\Company($faker));
    $faker->addProvider(new Faker\Provider\zh_TW\DateTime($faker));
    $faker->addProvider(new Faker\Provider\zh_TW\Internet($faker));
    $faker->addProvider(new Faker\Provider\zh_TW\Payment($faker));
    $faker->addProvider(new Faker\Provider\zh_TW\Person($faker));
    $faker->addProvider(new Faker\Provider\zh_TW\PhoneNumber($faker));
    $faker->addProvider(new Faker\Provider\zh_TW\Text($faker));

    return [
        'type' => $faker->numberBetween(1, 3),
        'serial_number' => $faker->regexify('A[0-9]{9}'),

        'last_name' => $faker->lastName,
        'first_name' => $faker->firstName,
        'gender' => $faker->numberBetween(1, 2),
        'identification' => $faker->regexify('[A-Z]{1}[0-9]{9}'),
        'birthday' => $faker->dateTime(),

        'email' => $faker->freeEmail(),
        'home_phone_number' => $faker->regexify('09[0-9]{8}'),
        'cell_phone_number' => $faker->regexify('02-[0-9]{8}'),

        'postcode' => $faker->postcode(),
        'city' => $faker->city(),
        'zone' => $faker->city(),
        'address' => $faker->address,

        'contact_last_name' => $faker->lastName,
        'contact_first_name' => $faker->firstName,
        'contact_cell_phone_number' => $faker->regexify('09[0-9]{8}'),
    ];
});
