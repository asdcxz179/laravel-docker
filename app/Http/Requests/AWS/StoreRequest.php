<?php

namespace App\Http\Requests\AWS;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            //file欄位為必填且檔案格式為圖片jpg,png,jpeg,git
            'file' => 'required|file|mimes:jpg,png,jpeg,gif',
        ];
    }

    /**
     * 取得自訂錯誤訊息
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'file.required' => '請選擇檔案',
            'file.file' => '請選擇檔案',
            'file.mimes' => '檔案格式錯誤',
        ];
    }
}
