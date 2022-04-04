<?php

namespace App;

use App\Core\DefaultModel;
use App\filters\core\HasModelFilter;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed name
 */
class Permission extends DefaultModel
{
    protected $appends = ['select_name'];

    public function getSelectNameAttribute(){
        return $this->name;
    }
}
