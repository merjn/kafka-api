<?php

namespace App\Presentation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => ['required'],
            'password' => ['required'],
            'email' => ['required'],
        ];
    }
}
