<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
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
        return [
            'title' => 'required|max:50',
            'description' => 'required|max:300',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'タイトルを入力してください',
            'description.required' => '詳細を入力してください',
        ];
    }
}
