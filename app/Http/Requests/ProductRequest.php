<?php namespace App\Http\Requests;

class ProductRequest extends Request {

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
            'category_id' => 'required|numeric',
            'quantity' => 'required|numeric',
            'description' => 'required',
            'pricePerHour' => 'numeric',
            'pricePerHourWeekend' => 'numeric',
            'pricePerDay' => 'numeric',
            'pricePerDayWeekend' => 'numeric',

            'pricePerProduct' => 'numeric',

            'pricePerHourOverFour' => 'numeric',
            'pricePerHourOverFourWeekend' => 'numeric',
            'pricePerThreeSixDays' => 'numeric',
            'pricePerWeek' => 'numeric',
            'pricePerWeekExtraDay' => 'numeric',

            'per_type_id' => 'required',

            'perTypeTime' => 'required_if:per_type_id,1',
            'startTime' => 'required_if:per_type_id,1,3',
            "pricePerBooking" => 'required_if:per_type_id,2',
            "pricePerProduct" => 'required_if:per_type_id,3',
            //"pricePerHour" => 'required_if:per_type_id,1|required_if:pricePerHourWeekend,0,pricePerHourOverFour,0'
            "reservepercentage" => "required|numeric",
        ];

    }

    public function messages()
    {
        return [
            'name.required' => trans('errors/product.nameRequired'),
            'name.min' => trans('errors/product.nameMin'),
            'category_id.required' => trans('errors/product.category_idRequired'),
            'category_id.numeric' => trans('errors/product.category_idNumeric'),
            'description.required' => trans('errors/product.descriptionRequired'),
            'quantity.required' => trans('errors/product.quantityRequired'),
            'quantity.numeric' => trans('errors/product.quantityNumeric'),
            'pricePerHour.numeric' => trans('errors/product.pricePerHourNumeric'),
            'pricePerHourWeekend.numeric' =>trans('errors/product.pricePerHourWeekendNumeric'),
            'pricePerDay.numeric' => trans('errors/product.pricePerDayNumeric'),
            'pricePerDayWeekend.numeric' => trans('errors/product.pricePerDayWeekendNumeric'),
            'pricePerProduct.numeric' => trans('errors/product.pricePerProductNumeric'),
            'pricePerHourOverFour.numeric' => trans('errors/product.pricePerHourOverFourNumeric'),
            'pricePerHourOverFourWeekend.numeric' => trans('errors/product.pricePerHourOverFourWeekendNumeric'),
            'pricePerThreeSixDays.numeric' => trans('errors/product.pricePerThreeSixDaysNumeric'),
            'pricePerWeek.numeric' => trans('errors/product.pricePerWeekNumeric'),
            'pricePerWeekExtraDay.numeric' => trans('errors/product.pricePerWeekExtraDayNumeric'),

            'per_type_id.required' => trans('errors/product.per_type_idRequired'),
            'perTypeTime.required_if' => trans('errors/product.perTypeTimeRequired_if'),

            'pricePerBooking.required_if' => trans('errors/product.pricePerBooking'),
            'pricePerProduct.required_if'  => trans('errors/product.pricePerProduct'),
            'perTypeTime.required_if'  => trans('errors/product.perTypeTime'),
            'startTime.required_if'  => trans('errors/product.startTime'),
            'reservepercentage.required' => trans('errors/product.reservepercentageRequired'),
            'reservepercentage.numeric' => trans('errors/product.reservepercentageNumeric'),
        ];
    }

}
