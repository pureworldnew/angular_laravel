<?php namespace App\Http\Requests;

class CentreRequest extends Request {

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
            "bookingFee" => 'required|numeric',

            'custom_text.admin_fee.de' => "required_if:useAdminFee,1",
            'custom_text.admin_fee.se' => "required_if:useAdminFee,1",
            'custom_text.admin_fee.en' => "required_if:useAdminFee,1",

            'adminFee' => "required_if:useAdminFee,1",//|sometimes|numeric|min:1
            /*'quantityAdminFee' => "sometimes|required"*/
            //'adminFee' => "required_if:useAdminFee,1|numeric:useAdminFee,1|min:1",

            /*'custom_text["invoice_text"]["en"]' => 'required|min:3',
            'custom_text["booking_conditions"]["en"]' => 'required|min:3'*/

            /*,
            'custom_text[payment_policy]' => 'required|min:3',
            'custom_text[confirmation_text]' => 'required|min:3',*/
        ];

    }

    public function messages()
    {
        return [
            'custom_text.admin_fee.en.required_if' => trans('errors/centre.adminFeeDescriptionEn'),
            'custom_text.admin_fee.se.required_if' => trans('errors/centre.adminFeeDescriptionSe'),
            'custom_text.admin_fee.de.required_if' => trans('errors/centre.adminFeeDescriptionDe'),
            'bookingFee.required' => trans('errors/centre.bookingFeeRequired'),
            'bookingFee.numeric' => trans('errors/centre.bookingFeeNumeric'),
            'adminFee.required_if' => trans('errors/centre.adminFeeRequired_if')
        ];
    }

}
