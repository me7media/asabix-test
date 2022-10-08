<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'data' => 'present|array',
            'data.*.title' => 'required|string',
            'data.*.description' => 'required|string',
            'data.*.content' => 'required|string',
        ];
    }


    public function messages()
    {
        return [
            'data.*.title.required' => 'Title is required!',
            'data.*.description.required' => 'dDescription is required!',
            'data.*.content.required' => 'Content is required!',
        ];
    }
}
