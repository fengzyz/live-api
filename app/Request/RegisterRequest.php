<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Request;

use Hyperf\Validation\Request\FormRequest;

class RegisterRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'code' => 'required',
            'encrypted_data' => 'required',
            'iv' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'code is required',
            'encrypted_data.required' => 'encrypted_data is required.',
            'iv.required' => 'iv is required.',
        ];
    }
}
