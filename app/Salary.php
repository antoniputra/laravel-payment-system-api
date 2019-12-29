<?php

namespace App;

use App\Employee;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    const STATUS_PENDING = 0;
    const STATUS_CONFIRMED = 1;
    const STATUS_REJECTED = 2;

    protected $fillable = [
        'hourly_rate', 'hours_spent', 'total_amount', 'start_at', 'end_at', 'status'
    ];

    protected $dates = [
        'start_at', 'end_at'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function scopeByEmployee($query, $employeeId)
    {
        return $query->where('employee_id', $employeeId);
    }

    public function setTotalAmountAttribute($value)
    {
        if ($this->attributes['hourly_rate'] && $this->attributes['hours_spent']) {
            $this->attributes['total_amount'] = $this->attributes['hourly_rate'] * $this->attributes['hours_spent'];
        } else {
            $this->attributes['total_amount'] = 0;
        }
    }
}
