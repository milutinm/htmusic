<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class ReleaseRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
		return Auth::user()->isAdmin();
//		return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [ // release
//			'id'				=> '',
			'artist_credit.id'		=> 'required|array',
			'artist_credit.id.*'	=> 'required|exists:artists,id',
			'artist_credit.work'	=> 'required|array',
			'artist_credit.work.*'	=> 'required|exists:work_type,id',
			'medium_id'				=> 'exists:mediums,id',
			'release_status_id'		=> 'exists:release_status,id',
			'name'					=> 'required',
			'date'					=> 'date',
//			'barcode'				=> '',
//			'notes'					=> '',
			'genre'					=> 'required|array',
			'genre.*'				=> 'required|exists:genres,id',
			'label'					=> 'array',
		];
    }
}
