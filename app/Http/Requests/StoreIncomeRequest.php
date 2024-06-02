<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use App\Helpers\ResponseHelper;

class StoreIncomeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "amount" => "required|integer|min:0",
            "category" => "required|string|exists:category,id",
            "note" => "nullable|string",
            "date" => "required|date",
            "time" => "required|date_format:H:i:s",
        ];
    }

    public function messages()
    {
        return [
            "amount.required" => "Jumlah harus diisi.",
            "amount.integer" => "Jumlah harus berupa angka.",
            "amount.min" => "Jumlah tidak boleh kurang dari 0.",
            "category.required" => "Kategori harus diisi.",
            "category.string" => "Kategori harus berupa string.",
            "category.exists" => "Kategori tidak valid.",
            "note.string" => "Catatan harus berupa string.",
            "date.required" => "Tanggal harus diisi.",
            "date.date" => "Tanggal tidak valid.",
            "time.required" => "Waktu harus diisi.",
            "time.date_format" =>
                "Format waktu tidak valid. Format yang benar adalah HH:MM:SS.",
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();

        throw new HttpResponseException(
            ResponseHelper::createResponse(400, $errors[0], null)
        );
    }
}
