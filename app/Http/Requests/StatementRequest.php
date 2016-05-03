<?php

namespace App\Http\Requests;

use App\ProjectMember;

class StatementRequest extends Request
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
     * Helper to get the mission statement for this request.
     *
     * @return array|string
     */
    public function getStatementTitle()
    {
        return $this->input('statement-title');
    }

    /**
     * Helper to get the tab body for this request.
     *
     * @return array|string
     */
    public function getStatementBody()
    {
        return $this->input('statement-body');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'statement-title' => 'required|regex:/(?=.*[a-zA-Z0-9])([A-Za-z0-9_ .]+)/|' . $this->betweenFormatter('statement-title'),
            'statement-body' => 'required|regex:/(?=.*[a-zA-Z0-9])([A-Za-z0-9_ .]+)/|' . $this->betweenFormatter('statement-body'),
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
            'statement-title.required' => 'A side box title is required.' ,
            'statement-title.between' => 'Side box title must be between :min and :max characters.',
            'statement-title.regex' => 'The :attribute must contain at least one letter/number.',

            'statement-body.required' => 'A side box body is required.' ,
            'statement-body.between' => 'Side box body must not be larger than :max characters.',
            'statement-body.regex' => 'The :attribute must contain at least one letter/number.',
        ];
    }
}
