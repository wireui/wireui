<?php

namespace WireUi\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ButtonRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'label' => 'sometimes|string',
            'variant' => 'sometimes|string',
            'color' => 'sometimes|string',
            'size' => 'sometimes|string',
            'icon' => 'sometimes|string',
            'rightIcon' => 'sometimes|string',
            'iconSize' => 'sometimes|string',
            'rounded' => 'sometimes|boolean',
            'squared' => 'sometimes|boolean',
            'bordered' => 'sometimes|boolean',
            'solid' => 'sometimes|boolean',
            'outline' => 'sometimes|boolean',
            'flat' => 'sometimes|boolean',
            'light' => 'sometimes|boolean',
        ];
    }
}
