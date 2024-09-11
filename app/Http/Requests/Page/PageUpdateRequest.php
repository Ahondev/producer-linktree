<?php

namespace App\Http\Requests\Page;

use App\Types\Appearance\ThemesTypes;
use App\Types\Link\PlatformTypes;
use Illuminate\Foundation\Http\FormRequest;

class PageUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(env("APP_ENV") === "local"){ return true; }
        if(auth()->user() === null){ return false; }
        return auth()->user()->email === "admin@ahon.dev";
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
//        dd($this->all());
        return [
            'title' => 'string|required|max:255',
            'text' => 'string|required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'links' => 'array',
            'links.*.platform' => 'required|string|in:' . self::getPlatforms(),  // Each link must have a valid platform
            'links.*.url' => 'required|url',  // Each link must have a valid URL
        ];
    }

    private function getPlatforms() { return join(",", PlatformTypes::types()); }

}
