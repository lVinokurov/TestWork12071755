<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        if(isset($this->id)) {
            $this->merge([
                'id' => $this->id
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|numeric|exists:articles,id',
            'title' => 'required|string|min:3',
            'slug' => 'required|string|unique:articles,slug,'.$this->id.',id',
            'text' => 'required|string'
        ];
    }
}
