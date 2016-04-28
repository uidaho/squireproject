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
     * Helper to get the title for this request.
     *
     * @return array|string
     */
    public function getTitle()
    {
        return $this->input('title');
    }

    /**
     * Helper to get the description for this request.
     *
     * @return array|string
     */
    public function getDescription()
    {
        return $this->input('description');
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
     * Helper to get the mission statement for this request.
     *
     * @return array|string
     */
    public function getStatement()
    {
        return $this->input('statement');
    }

    /**
     * Helper to get the tab title for this request.
     *
     * @return array|string
     */
    public function getTabTitle()
    {
        return $this->input('tab-title');
    }

    /**
     * Helper to get the tab body for this request.
     *
     * @return array|string
     */
    public function getTabBody()
    {
        return $this->input('tab-body');
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
            'description' => 'required|regex:/(?=.*[a-zA-Z0-9])([A-Za-z0-9_ .]+)/|' . $this->betweenFormatter('description'),
            'project-body' => 'required|regex:/(?=.*[a-zA-Z0-9])([A-Za-z0-9_ .]+)/|' . $this->betweenFormatter('project-body'),
            'thumbnail' => 'required|image|max:2048',    // max image size 2mb
            'statement' => 'required|regex:/(?=.*[a-zA-Z0-9])([A-Za-z0-9_ .]+)/|' . $this->betweenFormatter('statement'),
            'tab-title' => 'required|regex:/(?=.*[a-zA-Z0-9])([A-Za-z0-9_ .]+)/|' . $this->betweenFormatter('tab-title'),
            'tab-body' => 'required|regex:/(?=.*[a-zA-Z0-9])([A-Za-z0-9_ .]+)/|' . $this->betweenFormatter('tab-body'),
            'banner' => 'required|image|max:2048',    // max image size 2mb
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

            'description.required' => 'A description is required.',
            'description.between' => 'Description must be from :min to :max characters.',
            'description.regex' => 'The :attribute must contain at least one letter/number.',

            'project-body.required' => 'A full explanation of the project is required.' ,
            'project-body.between' => 'Project explanation must be between :min and :max characters.',
            'project-body.regex' => 'The :attribute must contain at least one letter/number.',

            'thumbnail.required' => 'An image for the project is required.',
            'thumbnail.max' => 'The file is larger than .',
            'thumbnail.image' => 'File is not an image.',

            'statement.required' => 'A mission statement is required.' ,
            'statement.between' => 'Mission statement must be between :min and :max characters.',
            'statement.regex' => 'The :attribute must contain at least one letter/number.',

            'tab-title.required' => 'A tab title is required.' ,
            'tab-title.between' => 'Tab title must be between :min and :max characters.',
            'tab-title.regex' => 'The :attribute must contain at least one letter/number.',

            'tab-body.required' => 'A tab body is required.' ,
            'tab-body.between' => 'Tab body must be between :min and :max characters.',
            'tab-body.regex' => 'The :attribute must contain at least one letter/number.',
        ];
    }
}
