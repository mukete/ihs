<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['name'];

    public $useTranslationFallback = true;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        
        $this->defaultLocale = 'de';
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }
}

// models/QuestionTranslation.php
class QuestionTranslation extends Model {

    public $timestamps = false;
    protected $fillable = ['name'];

}
