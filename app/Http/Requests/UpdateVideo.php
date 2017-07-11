<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Video;
use Illuminate\Support\Facades\Auth;
class UpdateVideo extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
         $video = Video::find($this->route('video'));

         return $video && ($video->created_by == Auth::id())  ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image'=>'mimes:jpg,jpeg,gif,png',
            'video'=>'mimes:mp4,mov,ogg,qt,3gp |min:200 |max:20000',
        ];
    }
}
