<?php namespace App\Http\Requests;
use App\Http\Requests\Request;
class AuthRequest extends Request {
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function authorize()
    {
        return true;
    }
	public function rules()
	{
		return [
			'email' 	=> 'required|email|max:80',
	        'password' 	=> 'required|min:6|max:20',
		];
	}
}