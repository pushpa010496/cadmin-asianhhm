<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;



class AdvaisoryBoardRequest extends FormRequest
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
                'title'=>'required|unique:advaisory_boards',                
                'description'=>'required',
                'active_flag'=>'required',
                'title_tag'=>'required',
                'alt_tag'=>'required',
                'home_description'=>'required',
                'image'=>'required|mimes:jpeg,png,jpg,gif,svg',
            ];
        }
        case 'PUT':
        case 'PATCH': {
            return [
             'title'=>'required',                      
             'description'=>'required',                    
             'active_flag'=>'required',
             'title_tag'=>'required',
             'home_description'=>'required',
             'alt_tag'=>'required',

         ];
     }
     default:
     break;
 }
}
}
