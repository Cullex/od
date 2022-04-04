<?php


namespace App\Core;


use App\filters\core\HasModelFilter;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;

class DefaultModel extends Model implements \OwenIt\Auditing\Contracts\Auditable
{
    use HasModelFilter , Auditable;
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
