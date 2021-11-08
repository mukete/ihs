<?php

namespace App;
use Illuminate\Database\Eloquent\Model;


class AnswerUser extends Model
{
    //
    public $table = 'answers_users';

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function answer(){
        return $this->belongsTo(Answer::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }


}


