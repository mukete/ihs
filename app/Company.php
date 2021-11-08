<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Company extends Model
{
    //

    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function users()
    {
        return $this->hasMany(User::class, 'company_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'company_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'company_id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'company_id');
    }

}
