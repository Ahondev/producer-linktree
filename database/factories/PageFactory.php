<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => 'Nouvel EP disponible',
            'text' => "Cliquez sur les liens ci dessous pour écouter l'EP sur votre plateforme favorite",
            'image_id' => 1
        ];
    }
}
