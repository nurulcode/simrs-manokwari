<?php

namespace App\Http\Requests;

use Sty\DropKey;
use Sty\RequestTransform;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    use RequestTransform;

    /**
     * The attributes value to map.
     *
     * @var array
     *
     */

    protected $map_values = ['password' => 'setPassword'];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => ['required'],
            'name'     => ['required'],
            'email'    => ['required', 'email'],
            'password' => ['required', 'confirmed'],
        ];
    }

    public function setPassword($value)
    {
        return ($this->route('user') && empty($value)) ? new DropKey : bcrypt($value);
    }
}
