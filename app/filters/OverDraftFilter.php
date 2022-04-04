<?php

namespace App\filters;

class OverDraftFilter extends BaseFilter
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
        'last_name',
        'first_name',
        'overdraft_tenure',
        'account_number',
        'amount',
        'status',
        'checker',
    ];
}
