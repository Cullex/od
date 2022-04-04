<?php

namespace App;

use App\filters\core\HasModelFilter;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Overdraft extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $auditInclude = [];
    use HasModelFilter;
    protected $fillable = [
        'last_name', 'first_name', 'overdraft_tenure', 'account_number', 'amount', 'status', 'checker',
    ];
}
