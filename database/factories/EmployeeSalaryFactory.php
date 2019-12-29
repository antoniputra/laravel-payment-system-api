<?php

use App\Salary;
use App\Employee;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    $jobStatus = rand(0, 1);
    $startAt = now()->subMonths(rand(12, 14));

    return [
        'hourly_rate' => $faker->randomFloat(2, 10, 30),
        'role' => $faker->jobTitle,
        'division' => $faker->randomElement([
            'ABC Division',
            'XYZ Division',
            'HIJ Division',
            'OPQ Division',
        ]),
        'contract' => Str::slug($faker->words(3, true)) . '.pdf',
        'job_status' => $jobStatus,
        'start_at' => $startAt,
        'end_at' => $jobStatus ? null : $startAt->addMonths(rand(6, 12)),
    ];
});


$factory->define(Salary::class, function (Faker $faker) {
    $startAt = now()->subMonths(rand(12, 14));

    return [
        'hourly_rate' => $faker->randomFloat(2, 10, 30),
        'hours_spent' => $faker->randomElement([4, 6, 8, 12]),

        'start_at' => $startAt,
        'end_at' => $startAt,
        'status' => rand(0, 1),
        
        // this will be done by Eloquent mutation
        'total_amount' => null,
    ];
});
