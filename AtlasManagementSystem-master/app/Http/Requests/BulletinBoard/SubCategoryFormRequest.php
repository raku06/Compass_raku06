<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubCategoryFormRequest extends FormRequest
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
            // 'main_category_name' => ['required', 'string', 'max:100', 'unique:main_categories,main_category'],
            'main_category_id' => ['required', 'exists:main_categories,id'],
            'sub_category_name' => ['required', 'string', 'max:100', Rule::unique('sub_categories', 'sub_category')
                    ->where('main_category_id', $this->main_category_id)],
        ];
    }

    public function messages(){
        return [
            // 'main_category_name.max' => 'メインカテゴリーは100文字以内で入力してください。',
            'main_category_name.unique' => '同じ名前のメインカテゴリーは登録できません。',
            'main_category_id.exists' => 'メインカテゴリーが登録されていません。',
            'sub_category_name.max' => 'サブカテゴリーは100文字以内で入力してください。',
            'sub_category_name.unique' => '同じ名前のサブカテゴリーは登録できません。',

            // 必須事項
            // 'main_category_name.required' => 'メインカテゴリーを入力してください。',
            'sub_category_name.required' => 'サブカテゴリーを入力してください。',
        ];
    }
}
