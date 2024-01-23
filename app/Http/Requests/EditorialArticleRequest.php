<?php



namespace App\Http\Requests;



use Illuminate\Foundation\Http\FormRequest;



class EditorialArticleRequest extends FormRequest

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

            // 'sub_title'=>'required',

            'issue_id'=>'required',

            'category_id'=>'required',

            'description'=>'required',

            // 'abstract'=>'required',

            'url'=>'required',

            'active_flag'=>'required',

            'short_description'=>'required',

            'image'=>'nullable',

            

        ];

            }

            case 'PUT':

            case 'PATCH': {

                return [

            'title'=>'required',

            // 'sub_title'=>'required',

            'issue_id'=>'required',

            'category_id'=>'required',

            'description'=>'required',

            // 'abstract'=>'required',

            'url'=>'required',

            'active_flag'=>'required',

            'short_description'=>'required',

            

        ];

            }

            default:

                break;

        }

         

    }



       

}

