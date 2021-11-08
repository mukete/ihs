<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    //
    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function delete() {
        if (file_exists(public_path() . '/content/documents/' . $this->file)) {
            @unlink(public_path() . '/content/documents/' . $this->file);
        }
        parent::delete();
    }
}
