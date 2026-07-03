<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class GetCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'search' => 'nullable|string',
            'category_id' => 'nullable|exists:course_categories,id',
            'level' => 'nullable|in:beginner,intermediate,advanced',
            'sort_by' => 'nullable|in:rating,enrolled_count,duration,created_at',
            'order' => 'nullable|in:asc,desc',
        ];
    }

    #[Override]
    public function messages()
    {
        return [
            'category_id.exists' => 'Kategori tidak ditemukan',
            'level.in' => 'Level tidak valid. Gunakan: beginner, intermediate atau advanced',
            'sort_by' => 'Sorting tidak valid. Gunakan:rating, enrolled_count, duration atau created_at',
            'order.in' => 'Order tidak valid. Gunakan: ascending atau descending',
        ];
    }
}
