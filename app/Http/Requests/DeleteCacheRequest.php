<?php

namespace App\Http\Requests;

use App\Enums\DeleteMethod;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeleteCacheRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'pattern' => ['required', 'string'],
            'method' => ['required', Rule::enum(DeleteMethod::class)],
        ];
    }
}
