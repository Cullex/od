<?php
/** @noinspection MethodShouldBeFinalInspection */
/** @noinspection MissingParameterTypeDeclarationInspection */
namespace App\filters;


use App\filters\core\ModelFilter;

class PermissionFilter extends BaseFilter
{
    protected $search = [
      'name',
    ];

}
