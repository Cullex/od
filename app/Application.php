<?php

namespace App;
use App\filters\core\HasModelFilter;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Application extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $auditInclude = [];
    use HasModelFilter;
    public function document(){
        return $this->hasOne(Document::class, 'user_id', 'user_id');
    }
    protected $fillable = ['applicantName', 'applicantSurname', 'vacancy', 'status',
        'decision', 'interviewDate', 'interviewTime',

    ];
}
