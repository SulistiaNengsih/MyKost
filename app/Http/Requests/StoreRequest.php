<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'jenis' => 'required',
            'keterangan' => 'required',
            'tanggal' => 'required',
            'nominal' => 'required',
            'foto' => 'bail|mimes:jpg,png,jpeg|image|max:2048'
        ];
    }
}
