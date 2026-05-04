<?php

namespace Modules\User\App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepositRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'regex:/^09[0-9]{9}$/'], 
            'amount' => ['required', 'numeric', 'min:1'],
            'image' => ['nullable', 'image'], 
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
