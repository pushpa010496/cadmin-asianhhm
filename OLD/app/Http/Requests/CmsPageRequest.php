<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CmsPageRequest extends FormRequest
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
                'title'=>'required|unique:cms_pages',            
                'url'=>'required',                        
                'description'=>'required',                
                'active_flag'=>'required',

            ];
        }
        case 'PUT':
        case 'PATCH': {
            return [
               'title'=>'required',      
               'url'=>'required',                            
               'description'=>'required',                    
               'active_flag'=>'required',
           ];
       }
       default:
       break;
   }
}
}
