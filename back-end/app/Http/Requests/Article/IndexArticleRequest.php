<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class IndexArticleRequest extends FormRequest
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
            'sortDesc' => 'required_with:sortBy|nullable|in:true,false',
            'sortBy' => [
                'string',
                'nullable',
                Rule::in(Schema::getColumnListing('articles'))
            ],
            'page' => 'numeric',
            'perPage' => 'required_with:page|numeric',
        ];
    }
}
