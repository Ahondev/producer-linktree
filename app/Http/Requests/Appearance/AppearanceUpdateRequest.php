<?php

namespace App\Http\Requests\Appearance;

use App\Types\Appearance\BackgroundTypes;
use App\Types\Appearance\ThemesTypes;
use App\Types\Link\PlatformTypes;
use Illuminate\Foundation\Http\FormRequest;

class AppearanceUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(env("APP_ENV") === "local"){ return true; }
        if(auth()->user() === null){ return false; }
        return auth()->user()->email === "admin@sxko666.com";
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'background_type' => 'required|string|required|in:' . self::getBackgoundTypes(),
            'value' => 'string|required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'theme' => 'required|string|in:' . self::getThemes(),
        ];
    }

    private function getBackgoundTypes() { return join(",", BackgroundTypes::types()); }
    private function getThemes() { return join(",", ThemesTypes::types()); }

}
