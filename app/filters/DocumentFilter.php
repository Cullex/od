<?php
/** @noinspection MethodShouldBeFinalInspection */
/** @noinspection MissingParameterTypeDeclarationInspection */
namespace App\Filters;


use App\filters\core\ModelFilter;

class DocumentFilter extends BaseFilter
{
    protected $search = [
        'name',
    ];

    protected $equal = [
        'document_type' , 'document_id'
    ];

}

