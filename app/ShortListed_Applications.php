<?php

namespace App;

use App\filters\core\HasModelFilter;
use Illuminate\Database\Eloquent\Model;

class ShortListed_Applications extends Model
{
    use HasModelFilter;

    protected $fillable = [
        'decision',
        'interviewDate',
        'interviewTime',
        'applicantName',
        'applicantSurname',
    ];
}
