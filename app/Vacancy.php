<?php

namespace App;
use App\filters\core\HasModelFilter;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
 use HasModelFilter;

    protected $fillable = ['title', 'department', 'description', 'category'];
    /**
     * @var mixed
     */

}
