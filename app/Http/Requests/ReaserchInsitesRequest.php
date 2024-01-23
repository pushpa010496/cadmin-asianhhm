<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReaserchInsitesRequest extends FormRequest
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
            'published_date' => 'required',
            'title' => 'required',
            'sub_title' => 'required',
            'author_details' => 'required',
            'description' => 'required',
            'url' => 'required',
            'active_flag' => 'required',
            'short_description' => 'required'
        ];
    }
}
