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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    //rules()の前に実行される
    //$this->merge(['key' => $value])を実行すると、
     //フォームで送信された(key, value)の他に任意の(key, value)の組み合わせをrules()に渡せる

    public function getValidatorInstance()
    {
        // プルダウンで選択された値(= 配列)を取得
        $old_year = $this->input('old_year', array()); //デフォルト値は空の配列
        $old_month = $this->input('old_month', array()); //デフォルト値は空の配列
        $old_day = $this->input('old_day', array()); //デフォルト値は空の配列

        // 日付を作成
        $data = $old_year . '-' . $old_month . '-' . $old_day;
        $birth_day = date('Y-m-d', strtotime($data));

        // rules()に渡す値を追加でセット
        //     これで、この場で作った変数にもバリデーションを設定できるようになる
        $this->merge([
            'birth_day' => $birth_day,
        ]);

        return parent::getValidatorInstance();
    }




    public function rules()
    {
        return [
            'over_name' => ['required', 'string', 'max:10'],
            'under_name' => ['required', 'string', 'max:10'],
            'over_name_kana' => ['required', 'string','regex:/\A[ァ-ヴー]+\z/u', 'max:30'],
            'under_name_kana' => ['required', 'string','regex:/\A[ァ-ヴー]+\z/u', 'max:30'],
            'mail_address' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'sex' => ['required', 'regex:/(1|2|3)/'],

            'birth_day' => ['required', 'after_or_equal:2000/1/1'],
            'role' => ['required', 'regex:/(1|2|3|4)/'],
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
            'over_name_kana.regex' => 'セイ：全角カナで入力してください。',
            'under_name_kana.regex' => 'メイ：全角カナで入力してください。',
            'mail_address.email' => 'メールアドレスを入力してください。',
            'sex.regex' => '性別を選択してください。2',
            'birth_day.date' => '存在しない日付です。',
            'birth_day.after_or_equal' => '2000年1月1日以降の生年月日のみ登録可能です。',
            'role.regex' => '権限を選択してください。2',
            'password-confirm.same' => 'パスワードと確認パスワードが一致しません。',
        ];
    }
}
