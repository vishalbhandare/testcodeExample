<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Router;
use Faker\Generator as Faker;

$factory->define(Router::class, function (Faker $faker) {
    $domainName = $faker->domainName;
    if (strlen($domainName) > 14) {
        $domainName = substr($domainName, 0, 10).'.com';
    } 
    $listItem = ['AG1', 'CSS'];
    $key = array_rand($listItem);


    return [
        'sapid' => $faker->regexify('[A-Za-z0-9]{18}'),
        'hostname' => $domainName,
        'loopback' => $faker->ipv4,
        'mac_address' => base_convert(str_replace(':','',$faker->macAddress), 16, 10),
        'type' => $listItem[$key]
    ];
});
