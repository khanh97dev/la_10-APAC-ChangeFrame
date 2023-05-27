<?php

namespace App\Http\Requests;

class FrameRequest extends MainRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if ($this->isCreate()) {
            return [
                'username' => 'required|max:255',
                'image'    => 'required|file|mimes:jpeg,png|max:2048',
            ];
        }
        if ($this->isUpdate()) {
            return [
                'username'         => 'required|unique|max:255',
                'image'            => 'file|mimes:jpeg,png|max:2048',
                'has_update_image' => 'required|boolean',
            ];
        }

        return [];
    }
}
