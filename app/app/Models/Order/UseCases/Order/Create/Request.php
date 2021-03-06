<?php

declare(strict_types=1);

namespace App\Models\Order\UseCases\Order\Create;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class Request
 */
class Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|uuid',
            'description' => 'required|string',
            'name' => 'required|string',
        ];
    }
}
