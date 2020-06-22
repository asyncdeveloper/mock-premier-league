<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FixtureRequest extends FormRequest
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
            case 'fixtures.store':
                return [
                    'title' => 'required|string|min:3|max:191',
                    'match_date' => 'required|date|date_format:Y-m-d H:i:00|after:'. date('Y-m-d H:i:00'),
                    'team1_id' => 'required|exists:teams,id',
                    'team2_id' => 'required|different:team1_id|exists:teams,id|'
                ];
                break;
            case 'fixtures.update':
                return  [
                    'title' => 'nullable|string|min:3|max:191',
                    'match_date' => 'nullable|date|date_format:Y-m-d H:i:00|after:'. date('Y-m-d H:i:00'),
                    'team1_id' => 'nullable|exists:teams,id',
                    'team2_id' => 'nullable|different:team1_id|exists:teams,id'
                ];
                break;
            default:
                return [];
        }
    }
}
