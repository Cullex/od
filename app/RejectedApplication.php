<?php

namespace App;

use App\filters\core\HasModelFilter;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class RejectedApplication extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $auditInclude = [];
    use HasModelFilter;
    protected $fillable = [
        'applicantName', 'applicantSurname', 'amount', 'approver', 'status', 'comment',
    ];
}
