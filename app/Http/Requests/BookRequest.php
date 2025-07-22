<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class BookRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
                return [
                    'title' => 'required|string|max:255',
                    'author' => 'required|string|max:255',
                    'description' => 'nullable|string',
                    'published_year' => 'nullable|string',
                    'pages' => 'nullable|integer',
                    'user_id' => 'required|integer|exists:users,id',
                ];
            case 'PATCH':
                return [
                    'title' => 'nullable|string|max:255',
                    'author' => 'nullable|string|max:255',
                    'description' => 'nullable|string',
                    'published_year' => 'nullable|string',
                    'pages' => 'nullable|integer',
                    'user_id' => 'nullable|integer|exists:users,id',
                ];
            default:
                throw new BadRequestException("Method {$this->method()} is not supported");
        }
    }
}
