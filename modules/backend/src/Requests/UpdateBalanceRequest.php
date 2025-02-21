<?php

namespace NSO\Backend\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBalanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //code logic ai được phép cộng tiền vào đây.
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'type' => 'in:credit,debit',
            'amount' => ['required', 'numeric', 'max:50000000'],
            'description' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'type' => 'Loại giao dịch không hợp lệ.',
            'amount.max' => 'Số tiền không được phép lớn hơn 50tr.',
            'description' => 'Nội dung là bắt buộc.',
        ];
    }
}
