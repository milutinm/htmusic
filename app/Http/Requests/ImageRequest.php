<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class ImageRequest extends Request
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
//            'id'		 		=> '',
//            'description'		=> '',
            'caption'			=> 'required',
            'source'       		=> 'url',
            'file'       		=> 'image',
            'artist_id'	        => 'required_without_all:release_id,track_id',
            'release_id'		=> 'required_without_all:artist_id,track_id',
            'track_id'  		=> 'required_without_all:artist_id,release_id',
            'artist_id.*'	    => 'exists:artists,id',
            'release_id.*'		=> 'exists:releases,id',
            'track_id.*'		=> 'exists:tracks,id',
        ];
    }
}
