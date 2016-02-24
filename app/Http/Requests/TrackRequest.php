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
			'artist_credit.id'		=> 'required|array',
			'artist_credit.id.*'	=> 'required|exists:artists,id',
			'artist_credit.work'	=> 'required|array',
			'artist_credit.work.*'	=> 'required|exists:work_type,id',
			'position'				=> 'integer',
			'release_id'			=> 'required|exists:releases,id',
			'number'				=> 'integer',
			'name'					=> 'required',
			'artist_credit_id'		=> 'exists:artist_credit,id',
			'length'				=> 'integer',
			'artist_credit'			=> 'required|array',
			'genre'					=> 'required|array',
			'genre.*'				=> 'required|exists:genres,id',
//			'notes'					=> '',
        ];
    }
}
