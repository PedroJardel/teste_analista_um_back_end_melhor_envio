<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewRequestFormRequest extends FormRequest
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
            'request.method' => 'required|string',
            'request.url' => 'required|string',
            'response.status' => 'required|numeric',
            'authenticated_entity.consumer_id.uuid' => 'required|string|uuid',
            'route.id' => 'required|string|uuid',
            'service.id' => 'required|string|uuid',
            'service.host' => 'required|string',
            'service.port' => 'required|numeric',
            'service.protocol' => 'required|string',
            'service.name' => 'required|string',
            'service.created_at' => 'required|numeric',
            'latencies.proxy' => 'required|numeric',
            'latencies.gateway' => 'required|numeric',
            'latencies.request' => 'required|numeric',
            'client_ip' => 'required|string',
        ];
    }
}
