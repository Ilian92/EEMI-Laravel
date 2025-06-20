<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name'     => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:25', 'alpha_dash', Rule::unique(User::class)->ignore($this->user()->id)],
            'email'    => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];

        if ($this->user()->is_creator) {
            $rules['bio']              = ['nullable', 'string', 'max:500'];
            $rules['profile_picture']  = ['nullable', 'image', 'max:2048'];
            $rules['banner_image']     = ['nullable', 'image', 'max:4096'];
            $rules['subscription_price'] = ['required', 'numeric', 'min:0'];
        }

        return $rules;
    }
}
