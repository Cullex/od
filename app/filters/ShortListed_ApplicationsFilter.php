<?php

namespace App\filters;

class ShortListed_ApplicationsFilter extends BaseFilter
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
        'decision',
        'interviewDate',
        'interviewTime',
        'applicantName',
        'applicantSurname',
    ];
}
