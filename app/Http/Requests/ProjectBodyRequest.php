<?php

namespace App\Http\Requests;

use App\Project;

class ProjectBodyRequest extends Request
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
     * Helper to get the body for this request.
     *
     * @return array|string
     */
    public function getBody()
    {
        return $this->input('project-body');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'project-body' => 'required|regex:/(?=.*[a-zA-Z0-9])([A-Za-z0-9_ .]+)/|' . $this->betweenFormatter('project-body'),
        ];
    }

    /**
     * Helper function to format the min/max rules
     *
     * @param $field
     * @return string formatted (i.e. "min:2|max:20")
     */
    private function betweenFormatter($field)
    {
        return 'between:' . Project::attributeLengths()[$field]['min'] . ',' . Project::attributeLengths()[$field]['max'];
    }

    /**
     * The messages that this returns on errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'project-body.required' => 'A full explanation of the project is required.' ,
            'project-body.between' => 'Project explanation must be between :min and :max characters.',
            'project-body.regex' => 'The :attribute must contain at least one letter/number.',
        ];
    }
}
