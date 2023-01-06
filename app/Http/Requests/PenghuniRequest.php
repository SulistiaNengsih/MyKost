<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenghuniRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nama' => 'required|max:225',
            'no_telepon' => 'required|numeric|digits_between:9,15',
            'status' => 'required|max:15',
            'no_kamar' => 'required|max:15'
        ];
    }
}