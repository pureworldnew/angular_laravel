<?php namespace App\Http\Requests;

class CategoryRequest extends Request {

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
            'name' => 'required|min:3',
            'description' => 'required'
            /*'image' => 'required'*/
        ];

    }
    public function messages()
    {
        return [
            'name.required' => trans('errors/category.nameRequired'),
            'name.min' => trans('errors/category.nameMin'),
            'description.required' => trans('errors/category.descriptionRequired')
        ];
    }

}
