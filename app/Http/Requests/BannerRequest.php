<?php

namespace App\Http\Requests;

class BannerRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Todo check is admin
        return $this->user() != null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'banner' => 'required|image|max:2048',    // max image size 2mb
        ];
    }

    /**
     * The messages that this returns on errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'banner.required' => 'A banner image is required.',
            'banner.max' => 'The file is larger than .',
            'banner.image' => 'File is not an image.',
        ];
    }
}
