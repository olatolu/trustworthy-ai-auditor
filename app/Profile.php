<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $guarded = ['created_at','deleted_at','updated_at'];


    public function profileResults()
    {
        return $this->hasMany(Result::class, 'profile_id', 'id');
    }
}
