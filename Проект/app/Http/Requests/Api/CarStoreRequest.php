<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CarStoreRequest extends FormRequest
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
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $encoded = $this->get('encoded');

        if($this->has('encoded') && !empty($encoded)) {
            $this->merge(
                json_decode($encoded, true)
            );
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'count' => ['required', 'numeric'],
            'pageCount' => ['required', 'numeric'],
            'page' => ['required', 'numeric'],
            'adverts' => ['required', 'array'],
            'adverts.*.id' => ['required', 'numeric'],
        ];
    }
}
