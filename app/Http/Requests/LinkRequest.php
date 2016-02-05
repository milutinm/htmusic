<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LinkRequest extends Request
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
            'id'		 		=> '',
            'caption'			=> 'required',
//            'description'		=> '',
            'url'       		=> 'required|url',
            'artist_id.*'	    => 'exists:artist,id',
            'release_id.*'		=> 'exists:release,id',
            'track_id.*'		=> 'exists:track,id',
        ];
    }
}
