<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KostRequest extends FormRequest
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
            'id' => 'required',
            'nama' => 'required|max:225',
            'alamat' => 'required|max:250',
            'biaya_sewa_bulanan' => 'required|numeric'
        ];
    }
}
