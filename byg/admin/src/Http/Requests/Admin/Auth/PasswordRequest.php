<?php

namespace Byg\Admin\Http\Requests\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'old_password'  =>  ['required','string','between:6,20',new \Byg\Admin\Rules\Auth\OldPasswordRule],
            'password'      =>  array_merge(config('admin.users.form.fields.password.api_rules.common'), config('admin.users.form.fields.password.api_rules.store')),
        ];
    }

    public function attributes(){
        return [
            'old_password'  =>  __('admin::Admin.admin.oldPassword'),
            'password'      =>  __(config('admin.users.form.fields.password.text')),
        ];
    }
}