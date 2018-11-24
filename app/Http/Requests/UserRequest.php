<?php

namespace App\Http\Requests;

use Sty\DropKey;
use Sty\RequestTransform;
use Illuminate\Validation\Rule;
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
        $unique = Rule::unique('users')->ignore(
            optional($this->route('user'))->id
        );

        return [
            'username'   => ['required', $unique],
            'name'       => ['required'],
            'email'      => ['required', 'email'],
            'password'   => ['nullable', 'confirmed', 'min:6'],
            'roles.*.id' => ['nullable', 'exists:roles,id']
        ];
    }

    public function setPassword($value)
    {
        return ($this->route('user') && empty($value)) ? new DropKey : bcrypt($value);
    }

    /**
    * Configure the validator instance.
    *
    * @param  \Illuminate\Validation\Validator  $validator
    * @return void
    */
    public function withValidator($validator)
    {
        $user = optional($this->route('user'))->id;

        $validator->sometimes('password', 'required', function ($input) use ($user) {
            return empty($user);
        });
    }
}
