<?php

use App\User;
use App\Salary;
use App\Employee;
use Illuminate\Database\Seeder;

class SimulationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for admin
        factory(User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com'
        ]);

        factory(User::class, 3)
            ->create()
            ->each(function ($user) {
                $user->employees()->save(factory(Employee::class)->make());

                $employee = $user->employees->first();
                $this->handleSalaries($employee);
            });
    }

    private function handleSalaries(Employee $employee)
    {
        // 1. Sample for monthly
        $employee->salaries()->save(factory(Salary::class)->make([
            'hourly_rate' => $employee->hourly_rate,
            'hours_spent' => 4 * 20,
            'start_at' => $employee->start_at->addMonths(1),
            'end_at' => $employee->start_at->addMonths(2),
        ]));
    }
}
