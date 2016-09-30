<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jokeLike extends Model
{
    public $timestamps = false;

    public function jokes()
    {
        $this->belongsTo('App\Joke');
    }
    public function users()
    {
        $this->belongsTo('App\User');
    }

}
