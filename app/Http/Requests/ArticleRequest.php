<?php namespace App\Http\Requests;
use App\Http\Requests\Request;
class ArticleRequest extends Request {
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
			'name' 	=> 'required|max:200',
	        'category' 	=> 'required',
	        'content' => 'required|max:5000'
		];
	}
}