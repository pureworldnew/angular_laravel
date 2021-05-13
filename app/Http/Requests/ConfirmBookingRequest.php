<?php namespace App\Http\Requests;

class ConfirmBookingRequest extends Request {

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
            "name" => 'required',
            "address" => 'required_if:takeCustomerDetails,true',
            "postCode" => 'required_if:takeCustomerDetails,true',
            "city" => 'required_if:takeCustomerDetails,true',
            "telephone" => 'required_if:takeCustomerDetails,true',
            "email" => 'required_if:takeCustomerDetails,true|email',
            'quantityAdminFee' => "required_if:usingAdminFee,1"
        ];

    }








    public function messages()
    {
        return [
            "name.required" => trans("errors/booking.nameRequired"),
            "address.required" => trans("errors/booking.addressRequired"),
            "postCode.required" => trans("errors/booking.postCodeRequired"),
            "city.required" => trans("errors/booking.cityRequired"),
            "telephone.required" => trans("errors/booking.telephoneRequired"),
            "email.required" => trans("errors/booking.emailRequired"),
            "email.email" => trans("errors/booking.emailEmail"),
            'quantityAdminFee.required_if' => trans('errors/booking.quantityAdminFeeRequired_if')
        ];
    }

}
