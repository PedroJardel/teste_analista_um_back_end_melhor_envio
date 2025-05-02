<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewGatewayServiceRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'service.id' => 'required|string|uuid',
            'service.host' => 'required|string',
            'service.port' => 'required|numeric',
            'service.protocol' => 'required|string',
            'service.name' => 'required|string',
            'service.created_at' => 'required|numeric'
        ];
    }
}
