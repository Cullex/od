<?php

namespace App;

use App\Core\DefaultModel;
use App\filters\core\HasModelFilter;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;

/**
 * @property mixed id
 * @property mixed name
 */
class Role extends  \Spatie\Permission\Models\Role implements \OwenIt\Auditing\Contracts\Auditable
{
    use HasModelFilter , Auditable;
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $appends = [
        'select_name','avatar_name'
    ];

    public function getSelectNameAttribute()
    {
        return $this->name;
    }

    public function getAvatarNameAttribute()
    {
        return strtoupper(substr($this->name ,  0 , 1 ));
    }
}
