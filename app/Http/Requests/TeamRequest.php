<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
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
        $routeName = $this->route()->getName();

        switch ($routeName) {
            case 'teams.store':
                return [
                    'name' => 'required|string|min:3|max:191',
                    'year_founded' => 'required|digits:4|integer|min:1500|max:'.(date('Y'))
                ];
                break;
            case 'teams.update':
                return  [
                    'name' => 'nullable|string|min:3|max:191',
                    'year_founded' => 'nullable|digits:4|integer|min:1500|max:'.(date('Y'))
                ];
                break;
            default:
                return  [];
        }
    }
}
