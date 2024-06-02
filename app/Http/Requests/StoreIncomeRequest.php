<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreIncomeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "amount" => "required|integer",
            "date" => "required|date_format:Y-m-d",
            "time" => "required|date_format:H:i:s",
            "category" => ["required", Rule::exists("category", "id")],
            "note" => "nullable|string",
        ];
    }

    public function messages()
    {
        return [
            "amount.required" => "Amount is required",
            "amount.integer" => "Amount must be an integer",
            "date.required" => "Date is required",
            "date.date_format" => "Date must be in the format YYYY-MM-DD",
            "time.required" => "Time is required",
            "time.date_format" => "Time must be in the format HH:MM:SS",
            "category.required" => "Category is required",
            "category.exists" => "Category must be valid",
        ];
    }
}
