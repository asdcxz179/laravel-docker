<?php

namespace Byg\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{    
    /**
     * 使用那個驗證類別
     *
     * @var string
     */
    public $type = 'store';
    
    /**
     * 驗證設定檔
     *
     * @var string
     */
    public $config_name = '';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->rules = [
        ];
        foreach(config($this->config_name) as $key => $field) {
            $this->rules[$key]   =  array_merge($field['api_rules']['common'],$field['api_rules'][$this->type]??[]);
        }
        return $this->rules;
    }

    public function attributes(){
        $data = [];
        foreach(config($this->config_name) as $key => $field) {
            $data[$key]   =  __($field['text']);
        }
        return $data;
    }
}
