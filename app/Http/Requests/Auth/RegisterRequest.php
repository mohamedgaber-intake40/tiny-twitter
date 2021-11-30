<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    protected static $stringMinLength   = 2;
    protected static $passwordMinLength = 6;
    protected static $stringMaxLength   = 100;
    protected static $imageMaxSize      = 10240;

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
            'name'          => ['required', 'min:' . self::$stringMinLength, 'max:' . self::$stringMaxLength,],
            'email'         => ['required', 'email','unique:users', 'max:' . self::$stringMaxLength,],
            'password'      => ['required', 'min:' . self::$passwordMinLength, 'max:' . self::$stringMaxLength, 'confirmed'],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'image'         => ['required', 'image', 'max:' . self::$imageMaxSize]
        ];
    }
}
