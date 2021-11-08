<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['name'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        
        $this->defaultLocale = 'de';
    }
}

// models/AnswerTranslation.php
class AnswerTranslation extends Model {

    public $timestamps = false;
    protected $fillable = ['name'];

}
