<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class WorkplaceRequest extends FormRequest
{

   /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
    public function index()
    {

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules(Request $request)
    {
        //
      $rules = [
           'title'=> ['required','regex:/^[a-zA-Z0-9öäåÖÄÅ\- ]+$/','min:3','max:50'],
           'price' => ['required','regex:/^\d*(\.\d{1,2})?$/'],
           'user_id' => ['required','integer'],
           'latitude' => ['regex:/^[-+]?[0-9]{1,7}(\.[0-9]+)?$/'],
           'longitude' => ['regex:/^[-+]?[0-9]{1,7}(\.[0-9]+)?$/'],
           'address' => ['regex:/(^[-0-9A-Za-zöäåÖÄÅ.,\/ ]+$)/'],
       ];
        if ($request->hasFile('image'))
          {
          $rules['image'] = array('image','mimes:jpg,png,jpeg,gif','max:4096');
          }
      else
          {
          $rules['image'] = 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
          }
        return $rules;

    }

    /**
   * Get custom attributes for validator errors.
   *
   * @return array
   */
    public function attributes()
    {
        return [
            'title' => 'Title is not valid. Title should contain at least three characters and maximun 50 chracters',
            'price' => 'Invalid value in price.',
            'user_id' => "User id is required and it should be integer",
        ];
    }

    protected function failedValidation(Validator $validator)
    {
          throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
