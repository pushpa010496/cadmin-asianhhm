<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorguidelineRequest extends FormRequest
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
       switch ($this->method()) {
        case 'GET':
        case 'DELETE': {
            return [];
        }
        case 'POST': {
            return [
                'title'=>'required',                            
                'description'=>'required',         
                'url'=>'required',
                'active_flag'=>'required',
                'title_tag'=>'required',
                'alt_tag'=>'required',            
                'pdf'=>'required',

            ];
        }
        case 'PUT':
        case 'PATCH': {
            return [
               'title'=>'required',                      
               'description'=>'required',         
               'url'=>'required',
               'active_flag'=>'required',
               'title_tag'=>'required',
               'alt_tag'=>'required',

           ];
       }
       default:
       break;
   }
}
}
