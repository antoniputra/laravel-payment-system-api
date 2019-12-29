<?php

namespace App;

use App\User;
use App\Salary;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    const JOB_STATUS_INACTIVE = 0;
    const JOB_STATUS_ACTIVE = 1;
    const JOB_STATUS_TRANSITION = 2;

    protected $fillable = [
        'role', 'division', 'hourly_rate', 'contract', 'start_at', 'end_at', 'job_status', 'job_status_description'
    ];

    protected $dates = [
        'start_at', 'end_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }
}
