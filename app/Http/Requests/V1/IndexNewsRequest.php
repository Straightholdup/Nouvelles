<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class IndexNewsRequest extends FormRequest
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
            'author_id' => 'sometimes|integer',
            'category_id' => 'sometimes|integer',
            'include_subcategories' => 'sometimes|boolean',
            'title' => 'sometimes|string',
        ];
    }
}
