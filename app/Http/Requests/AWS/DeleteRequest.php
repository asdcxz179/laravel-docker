<?php

namespace App\Http\Requests\AWS;

use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'file' =>   [
                'required',
                'string',
                'regex:/\.(jpg|png|jpeg|gif)$/i',
            ],
        ];
    }

    public function messages()
    {
        return [
            'file.required' => '文件欄位是必填的。',
            'file.string' => '文件欄位必須為字串。',
            'file.regex' => '文件欄位必須以副檔名 jpg, png, jpeg, gif 結尾。',
        ];
    }
    
}
