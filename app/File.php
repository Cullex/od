<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'vacancy', 'oLevel', 'aLevel', 'diploma', 'degree', 'masters', 'certifications', 'userId'
    ];
}
