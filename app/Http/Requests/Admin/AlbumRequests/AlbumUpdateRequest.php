<?php

namespace App\Http\Requests\Admin\AlbumRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AlbumUpdateRequest extends FormRequest
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
        $id = $this->route('id'); // get from route
        // $id = $this->request->get('record_id'); // get from in blade

        return [
            'name' => 'required|string|max:254|unique:albums,name,' . $id,
            'images.*.name' => 'nullable|max:254',
            'images.*.image' => 'required_if:images.*.record_id,0|mimes:png,jpg,jpeg,webm,webp|max:2049',
        ];
    }
}
