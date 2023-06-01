<?php

namespace Sayedsoft\ExchangeToken\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExchangeValidateRequest extends FormRequest
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
            'base_amount'    => 'required|numeric',
            'qoute_amount'   => 'required|numeric',
            'type'           => 'required|in:BUY,SELL',
            'pair_id'        => 'required|exists:dex_exchange_pairs,id',
        ];
    }
}
