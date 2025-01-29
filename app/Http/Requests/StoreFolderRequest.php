<?php

namespace App\Http\Requests;

use App\Models\File;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreFolderRequest extends FormRequest
{
    public File|null $parent = null;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $this->parent = File::query()->where('id', $this->parent_id)->first();
        if ($this->parent && !$this->parent->isOwner(Auth::id())) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'parent_id' => [
                'nullable',
                Rule::exists(File::class, 'id')
                    ->where('created_by', Auth::id())
                    ->where('is_folder', true),
            ],
            'name' => [
                'required',
                Rule::unique(File::class, 'name')
                    ->where('created_by', Auth::id())
                    ->where('parent_id', $this->parent?->id)
                    ->whereNull('deleted_at'),
            ],
        ];
    }
}
