<?php

namespace App\Http\Requests;

/**
 * Class DeleteProjectRequest
 *
 * Validates that the user is allowed to delete
 * a project.
 *
 * @see \App\Http\Controllers\ProjectController::delete
 *
 * @author Rick Boss
 * @package App\Http\Requests
 */
class DeleteProjectRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->project->isUserAuthor($this->user());

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
