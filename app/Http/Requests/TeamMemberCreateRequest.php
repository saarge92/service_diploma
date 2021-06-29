<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamMemberCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:1024',
            'position' => 'required|string|max:1024',
            'photo' => 'required|mimes:jpeg,png,jpg,gif,svg|max:15000',
            'vk_url' => 'nullable|url',
            'instagram_url' => 'nullable|url'
        ];
    }
}
