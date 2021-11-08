<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //

    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name'];


    public function users() {
        return $this->belongsToMany(User::class, 'department_users', 'department_id', 'user_id');
    }

    public function company() {
        return $this->belongsTo(Company::class, );
    }
}

// models/CategoryTranslation.php
class DepartmentTranslation extends Model {

    public $timestamps = false;
    protected $fillable = ['name'];

}
