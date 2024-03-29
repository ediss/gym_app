<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        $this->mergeIfMissing([
            'remember'  => false,
        ]);
    }



    public function rules(): array
    {

        return [
            'email' => [
                'email',
                'required',
            ],
            'password' => [
                'string',
                'required',
            ],

            'remember' => '',
        ];
    }
}
