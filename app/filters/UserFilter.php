<?php
/** @noinspection MethodShouldBeFinalInspection */
/** @noinspection MissingParameterTypeDeclarationInspection */
namespace App\filters;


use App\filters\core\ModelFilter;

class UserFilter extends ModelFilter
{
    protected  $filters = [
        'search'
    ];
    protected  $equal = [
        'id',
        'roles.name'
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
      'name',
      'last_name',
      'email',
    ];

}
