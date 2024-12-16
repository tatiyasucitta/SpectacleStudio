<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $desc=[
            'Classic aviator glasses for men.',
            'Stylish retro round frames.',
            'Modern square-shaped glasses.',
            'Fashionable cat-eye frames.',
            'Protect your eyes from blue light.',
            'Perfect sunglasses for active wear.',
            'Vintage tortoiseshell frames.',
            'Durable and fun glasses for kids.',
            'High-quality polarized lenses.'
        ];

        $name=[
            'Classic Aviators',
            'Retro Round Frames',
            'Modern Square Glasses',
            'Cat-Eye Frames',
            'Blue Light Blockers',
            'Sporty Sunglasses',
            'Vintage Tortoiseshell',
            'Kids Fun Glasses',
            'Polarized Sunglasses'
        ];

        for ($i=0; $i < 8; $i++) { 
            Product::create([
                'name' => $name[$i],
                'price' => rand(100,400), 
                'stock' => rand(1, 20),
                'category_id' => rand(1,4), 
                'description' => $desc[$i],
            ]);
        }
    }
}
