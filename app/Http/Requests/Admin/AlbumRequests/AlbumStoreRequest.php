<?php

namespace App\Http\Requests\Admin\AlbumRequests;

use Illuminate\Foundation\Http\FormRequest;

class AlbumStoreRequest extends FormRequest
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
            'name' => 'required|string|max:254|unique:albums,name',
            'images.*.name' => 'nullable|max:254',
            'images.*.image' => 'nullable|mimes:png,jpg,jpeg,webm,webp|max:2049',
        ];
    }
}
