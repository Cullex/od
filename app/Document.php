<?php

namespace App;

use App\Core\DefaultModel;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed path
 * @property mixed name
 */
class Document extends DefaultModel
{
    protected $with = ['user'];

    public function user()
    {
        return $this->hasOne(User::class , 'id' , 'user_id');
    }

}

