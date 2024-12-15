<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class GoodsInRequest extends FormRequest
{
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
        return ['client_name' => 'required','project_name'=>'required','client_order_number'=>'required','goods_in_date'=>'required','charge_rate'=>'numeric'];
        
			
        

        
	}
}
