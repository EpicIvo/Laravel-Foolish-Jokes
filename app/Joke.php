<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Joke extends \Eloquent
{
    public function likes(){
        return $this->hasMany('App\jokeLike');
    }
}
