<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignCountryRequest extends FormRequest
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
        return [
            'campaign_id'=>'required|alpha_num'
        ];
    }

    public function messages()
{
    return [
        'campaign_id.required' => 'required',
        'campaign_id.alpha' => 'No se ha actualizado',
    ];
}
}
