<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patients';

    protected $fillable = [
        'id', 'run', 'dv', 'other_identification', 'name', 'fathers_family',
        'mothers_family', 'gender', 'birthday','address','telephone', 'status', 'deceased_at'
    ];

    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'birthday'  => 'date:Y-m-d'
    ];

    public function communes() {
        return $this->hasMany('\App\Commune');
    }

    public function exams() {
        return $this->hasMany('\App\Exam', 'patient_id', 'id');
    } 

    protected $appends = ["fullname","age"];


    public function getAgeAttribute() {
        if($this->birthday) {
            return $this->birthday->diffInYears(\Carbon\Carbon::now());
        }
        else {
            return $this->birthday;
        }
    }

    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->fathers_family} {$this->mothers_family}";
    }

}
