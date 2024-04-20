<?php

namespace App\Http\Requests;

use App\DTO\UserDto;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class UserRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'phone', 'unique:'.User::class],
            'link_page_a' => ['required', 'string', 'unique:'.User::class],
            'is_active' => ['required', 'boolean'],
            'email' => ['string', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    /**
     * @return UserDto
     */
    public function createDto(): UserDto
    {
        return UserDto::createFromArray($this->all());
    }

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
