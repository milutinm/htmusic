<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;


class ArtistAliasRequest extends Request
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
//			'id'			 		=> '',
			'artist_id'				=> 'required|exists:artists,id',
			'name'					=> 'required',
			'sort_name'				=> 'required',
			'begin_date'			=> 'date',//|before:end_date',
			'is_ended'				=> 'boolean',
			'end_date'				=> 'date|after:begin_date',
			'artist_alias_type_id'	=> 'exists:artist_alias_types,id',
        ];
    }
}
