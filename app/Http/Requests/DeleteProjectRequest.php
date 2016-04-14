<?php

namespace App\Http\Requests;


use App\Project;
use Illuminate\Support\Facades\Auth;

class DeleteProjectRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = $this->user();
        return $this->user() != null && $this->project->author == $user->username;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
