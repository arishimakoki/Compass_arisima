<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
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

    public function getValidatorInstance()
    {
        if ($this->input('old_day') && $this->input('old_month') && $this->input('old_year'))
        {
            $birth_day = implode('-', $this->only(['old_year', 'old_month', 'old_day']));
            $this->merge([
                'birth_day' => $birth_day,
            ]);
        }

        return parent::getValidatorInstance();
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            /**新規登録用バリデーション */
            'birth_day' => 'after_or_equal:2000-01-01|before:now',
            'over_name' => 'required|string|max:10',
            'under_name' => 'required|string|max:10|',
            'over_name_kana' => 'required|string|max:30|required|regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u',
            'under_name_kana' => 'required|string|max:30|required|regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u',
            'mail_address' => 'required|email|max:100|unique:users',
            'sex' => 'numeric|between:1,3|required',
            'old_year' => 'required',
            'old_month' => 'required',
            'old_day' => 'required',
            'role' => 'numeric|between:1,4|required',
            'password' => 'min:8|max:30|required',
            'password_confirm' => 'required|same:password',
        ];
    }
}
