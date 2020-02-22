<?php

namespace App\Http\Requests;

use App\Enums\MoodsEnum;
use Illuminate\Validation\Rule;

class DiaryEntryRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content' => 'nullable',
            'mood' => ['required', Rule::in(MoodsEnum::getValues())],
            'entry_date' => 'required|date',
        ];
    }
}
