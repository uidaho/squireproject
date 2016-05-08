<?php

namespace App\Http\Requests;

use App\Project;

/**
 * Class ProjectTitleRequest
 *
 * Provides helper functions and validation for a edit project title request
 *
 * @author Robert Breckenridge (original)
 * @author Rick Boss (editor)
 * @package App\Http\Requests
 */
class ProjectTitleRequest extends Request
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
     * Helper to get the title for this request.
     *
     * @return array|string
     */
    public function getTitle()
    {
        return $this->input('title');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:projects|regex:/(?=.*[a-zA-Z0-9])([A-Za-z0-9_ .]+)/|' . $this->betweenFormatter('title'),
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
            'title.required' => 'A title is required.',
            'title.unique' => 'The title must be unique.',
            'title.regex' => 'The :attribute must contain at least one letter/number.',
            'title.between' => 'The :attribute must be from :min to :max characters.',
        ];
    }
}
