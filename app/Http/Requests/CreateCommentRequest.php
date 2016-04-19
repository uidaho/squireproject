<?php

namespace App\Http\Requests;

class CreateCommentRequest extends Request
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
            'comment_body' => 'required|min:6|max:256|regex:/(?=.*[a-zA-Z])(.*?)/s',
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
            'comment_body.required' => 'A comment is required.',
            'comment_body.min' => 'Your comment must include at least 6 characters.',
            'comment_body.max' => 'Your comment must be shorter than 256 characters.',
            'comment_body.regex' => 'Your comment must contain a letter.',
        ];
    }
}