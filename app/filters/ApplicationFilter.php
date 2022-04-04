<?php

namespace App\filters;

class ApplicationFilter extends BaseFilter
{
    protected  $filters = [
        'search'
    ];
    protected  $equal = [
        'id',
    ];
    protected  $dates = [
        'created_at',
        'updated_at'
    ];
    protected  $sort = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $search = [
        'vacancy',
        'status',
        'applicantName',
        'applicantSurname',
    ];
}
