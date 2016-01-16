<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class TrackRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
		return Auth::user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
//            'id'				=> '',
			'position'			=> 'integer',
			'release_id'		=> 'exists:release,id',
			'number'			=> 'integer',
			'name'				=> 'required',
			'artist_credit_id'	=> 'exists:artist_credit,id',
			'length'			=> 'integer',
//			'notes'				=> '',
        ];
    }
}
