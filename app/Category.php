<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    //
    use \Dimsav\Translatable\Translatable;
    use Sluggable;

    public $translatedAttributes = ['name'];

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

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function courses() {
        return $this->hasMany(Course::class);
    }


    public function delete()
    {
        if (file_exists(public_path() . '/content/category/' . $this->image)) {
            @unlink(public_path() . '/content/category/' . $this->image);
        }
        parent::delete();
    }

}

// models/CategoryTranslation.php
class CategoryTranslation extends Model {

    public $timestamps = false;
    protected $fillable = ['name'];

}
