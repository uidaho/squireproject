<?php

namespace App\Http\Requests;

/**
 * Class ProjectThumbnailRequest
 *
 * Provides helper functions and validation for a edit project thumbnail request
 *
 * @author Robert Breckenridge (original)
 * @package App\Http\Requests
 */
class ProjectThumbnailRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'thumbnail' => 'required|image|max:2048',    // max image size 2mb
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
            'thumbnail.required' => 'An image for the project is required.',
            'thumbnail.max' => 'The file is larger than .',
            'thumbnail.image' => 'File is not an image.',
        ];
    }
}
