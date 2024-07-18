<?php

namespace Byg\Admin\Models\Universal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Repository;
use OwenIt\Auditing\Contracts\Auditable;
use Byg\Admin\Traits\QueryTrait;

class Model extends Repository implements Auditable
{
    use HasFactory,QueryTrait;
    use \OwenIt\Auditing\Auditable;
}