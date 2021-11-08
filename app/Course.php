<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Course extends Model
{
    //
    use \Dimsav\Translatable\Translatable;
    use Sluggable;

    public $translatedAttributes = ['name','description'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        
        $this->defaultLocale = 'en';
    }
    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function contents()
    {
        return $this->hasMany(Content::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}

// models/CourseTranslation.php
class CourseTranslation extends Model {

    public $timestamps = false;
    protected $fillable = ['name', 'description'];

}
