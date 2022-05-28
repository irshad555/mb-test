<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $validator = [
            'Title' => ['required', 'string', 'max:255'],
//'categoryType' => 'required',
        ];

        // return response()->json(['status' => 0, 'error' => $validator]);

        return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
    }
}
