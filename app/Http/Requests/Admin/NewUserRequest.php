<?php namespace App\Http\Requests\Admin;

use Illuminate\Http\Request;

class NewUserRequest extends Request {

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
            'email' => 'required|min:3'
        ];

    }
    public function messages()
    {
        return [
            "email.required" => trans('errors/user.emailRequired'),
            "email.email" => trans('errors/user.emailEmail')
        ];
    }
}
