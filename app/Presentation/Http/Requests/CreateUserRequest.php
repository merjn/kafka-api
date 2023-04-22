<?php

namespace App\Presentation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\RequestBody(
 *     request="CreateUserRequest",
 *     required=true,
 *     description="Create user request",*
 *     @OA\JsonContent(ref="#/components/schemas/CreateUserRequest")
 * ),
 *
 * @OA\Schema(
 *      schema="CreateUserRequest",
 *      type="object",
 *      @OA\Property(
 *          type="string",
 *          property="username"
 *      ),
 *
 *      @OA\Property(
 *          type="string",
 *          property="password"
 *      ),
 *
 *      @OA\Property(
 *          type="string",
 *          property="email"
 *      ),
 *
 *      @OA\Property(
 *          type="string",
 *          property="motto"
 *      ),
 *
 *      @OA\Property(
 *          type="string",
 *          property="look"
 *      )
 * )
 */
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
