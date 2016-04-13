<?php

namespace App\Http\Requests;

use App\Project;

class CreateProjectRequest extends Request
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
            'title' => 'required|unique:projects|' . $this->minMaxFormatter('title'),
            'description' => 'required|' . $this->minMaxFormatter('description'),
            'project-body' => 'required|' . $this->minMaxFormatter('project-body'),
            'thumbnail' => 'required|image|max:2048'    // max image size 2mb
        ];
    }

    /**
     * Helper function to format the min/max rules
     *
     * @param $field
     * @return string formatted (i.e. "min:2|max:20")
     */
    private function minMaxFormatter($field)
    {
        return 'min:' . Project::attributeLengths()[$field]['min'] . '|max:' . Project::attributeLengths()[$field]['max'];
    }

    /**
     * The messages that this returns on errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title' => [
                'required' => 'A title is required.',
                'unique' => 'The title must be unique.',
                'min' => 'The title must be longer.',
                'max' => 'The title must be shorter than 50 characters.',
            ],
            'description' => [
                'required' => 'A description is required.',
                'min' => 'Description must be at least 10 characters.',
                'max' => 'Description must be shorter than 100 characters.',
            ],
            'project-body' => [
                'required' => 'A full explanation of the project is required.' ,
                'min' => 'Project explanation must be at least 100 characters.',
                'max' => 'Project explanation must be shorter than 65535 characters.',
            ],
            'thumbnail' => [
                'required' => 'An image for the project is required.',
                'max' => 'The file is larger than 2mb.',
                'image' => 'File is not an image.',
            ]
        ];
    }
}
