<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $image = new Image([
            'id' => 1,
            'name' => 'placeholder-image',
            'source' => '/uploads/placeholder.png',
        ]);
        $image->save();
    }
}
