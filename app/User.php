<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function answerUser(){
        return $this->hasMany(AnswerUser::class);
    }

    public function took(){
        return $this->hasMany(Take::class);
    }


    public function departments() {
        return $this->belongsToMany(Department::class, 'department_users', 'user_id', 'department_id');
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }
}
