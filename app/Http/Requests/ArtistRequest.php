<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class ArtistRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
		return true;
//        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
			'id'		 		=> '',
			'name'				=> 'required',
			'sort_name'			=> 'required',
			'begin_date'		=> 'date|before:end_date',
			'is_ended'			=> 'boolean',
			'end_date'			=> 'date|after:begin_date',
			'artist_type_id'	=> 'exists:artist_types,id',
			'gender'			=> 'in:male,female,other',
//			'bio'				=> '',
			'photo_url'			=> 'url',
        ];
    }
}
