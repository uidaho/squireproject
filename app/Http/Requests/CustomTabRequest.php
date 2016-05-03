<?php

namespace App\Http\Requests;

use App\ProjectMember;

class CustomTabRequest extends Request
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
            'tab-title' => 'required|regex:/(?=.*[a-zA-Z0-9])([A-Za-z0-9_ .]+)/|' . $this->betweenFormatter('tab-title'),
            'tab-body' => 'required|regex:/(?=.*[a-zA-Z0-9])([A-Za-z0-9_ .]+)/|' . $this->betweenFormatter('tab-body'),
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
        return 'between:' . ProjectMember::attributeLengths()[$field]['min'] . ',' . ProjectMember::attributeLengths()[$field]['max'];
    }

    /**
     * The messages that this returns on errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'tab-title.required' => 'A tab title is required.' ,
            'tab-title.between' => 'Tab title must be between :min and :max characters.',
            'tab-title.regex' => 'The :attribute must contain at least one letter/number.',

            'tab-body.required' => 'A tab body is required.' ,
            'tab-body.between' => 'Tab body must not be larger than :max characters.',
            'tab-body.regex' => 'The :attribute must contain at least one letter/number.',
        ];
    }
}
