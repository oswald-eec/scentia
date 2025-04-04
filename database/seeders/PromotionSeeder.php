<?php

namespace Database\Seeders;

use App\Models\Promotion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $promotions = [
            [
                'name' => 'Descuento de Invierno',
                'image_url' => 'img/default/winter-sale.jpg',
                'description' => 'Aprovecha nuestro 30% de descuento en todos los cursos durante el invierno.',
            ],
            [
                'name' => 'Oferta de Verano',
                'image_url' => 'img/default/summer-deal.jpg',
                'description' => 'Obtén un 25% de descuento en cursos seleccionados por tiempo limitado.',
            ],
        ];

        // Crear las promociones en la base de datos
        foreach ($promotions as $promotion) {
            Promotion::create($promotion);
        }
    }
}
