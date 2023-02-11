<?php

namespace App\Http\Requests;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'over_name' => ['required', 'string', 'max:10'],
            'under_name' => ['required', 'string', 'max:10'],
            'over_name_kana' => ['required', 'string','regex:/\A[ァ-ヴー]+\z/u', 'max:30'],
            'under_name_kana' => ['required', 'string','regex:/\A[ァ-ヴー]+\z/u', 'max:30'],
            'mail_address' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'sex' => ['required', 'regex:/(男性|女性|その他)/'],
            'birth_day' => ['required', 'after_or_equal:2000/1/1'],
            'role' => ['required', 'regex:/(講師(国語)|講師(数学)|講師(英語)|生徒)/'],
            'password' => ['required', 'string', 'min:8','max:30'],
            'password-confirm' => ['required', 'same:password'],
        ];
    }

    public function messages(){
        return [
            // 必須入力
            'over_name.required' =>'姓を入力してください。',
            'under_name.required' =>'名を入力してください。',
            'over_name_kana.required' =>'セイを入力してください。',
            'under_name_kana.required' =>'メイを入力してください。',
            'mail_address.required' =>'メールアドレスを入力してください。',
            'sex.required' =>'性別を選択してください。',
            'birth_day.required' =>'生年月日を選択してください。',
            'role.required' =>'権限を選択してください。',
            'password.required' =>'パスワードを入力してください。',
            'password-confirm.required' =>'確認用パスワードを入力してください。',
            // 文字制限
            'over_name.max' => '姓は10文字以内で入力してください。',
            'under_name.max' => '名は10文字以内で入力してください。',
            'over_name_kana.max' => 'セイは30文字以内で入力してください。',
            'under_name_kana.max' => 'メイは30文字以内で入力してください。',
            'mail_address.max' => 'メールアドレスは100文字以内で入力してください。',
            'password.max' => 'パスワードは8文字以上30文字以内で入力してください。',
            'password.min' => 'パスワードは8文字以上30文字以内で入力してください。',
            // 正規表現
            'over_name_kana.regex' => '全角カナで入力してください。',
            'under_name_kana.regex' => '全角カナで入力してください。',
            'mail_address.email' => 'メールアドレスを入力してください。',
            'sex.regex' => '性別を選択してください。',
            'birth_day.after_or_equal' => '2000年1月1日以降の生年月日のみ登録可能です。',
            'role.regex' => '権限を選択してください。',
            'password.confirmed' => 'パスワードと確認パスワードが一致しません。',
        ];
    }
}
