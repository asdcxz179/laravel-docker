<?php

namespace Byg\Admin\Http\Requests\Admin\Group;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends \Byg\Admin\Http\Requests\BaseRequest
{
    public $type = 'store';

    public $config_name = 'admin.groups.form.fields';
}
