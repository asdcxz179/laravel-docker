<?php

namespace Byg\Admin\Http\Requests\Admin\Auth;

class LoginRequest extends \Byg\Admin\Http\Requests\BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'account'   =>  ['required','string','max:50','exists:admin_users,account'],
            'password'  =>  ['required','string','between:6,12'],
            // 'captcha'   =>  ['required','captcha'],
        ];
    }

    public function attributes(){
        return [
            'email'     =>  __('admin::Admin.admin.email'),
            'password'  =>  __('admin::Admin.admin.password'),
            'captcha'   =>  __('admin::Admin.admin.captcha'),
        ];
    }
}
