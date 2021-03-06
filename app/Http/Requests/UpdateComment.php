<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class UpdateComment extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $comment = Comment::find($this->route('comment'));

        return $comment && ($comment->created_by == Auth::id())  ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'comment'=>'min:1, max:200'
        ];
    }
}
