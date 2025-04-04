<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtener las categorías existentes
        $webDevelopment = Category::where('name', 'Desarrollo Web')->first();
        $electronics = Category::where('name', 'Electronica')->first();
        $masonry = Category::where('name', 'Albañileria')->first();

        // Subcategorías de Desarrollo Web
        Subcategory::create([
            'name' => 'Frontend',
            'category_id' => $webDevelopment->id
        ]);

        Subcategory::create([
            'name' => 'Backend',
            'category_id' => $webDevelopment->id
        ]);

        Subcategory::create([
            'name' => 'Full Stack',
            'category_id' => $webDevelopment->id
        ]);

        // Subcategorías de Electrónica
        Subcategory::create([
            'name' => 'Robótica',
            'category_id' => $electronics->id
        ]);

        Subcategory::create([
            'name' => 'Microcontroladores',
            'category_id' => $electronics->id
        ]);

        // Subcategorías de Albañilería
        Subcategory::create([
            'name' => 'Estructuras',
            'category_id' => $masonry->id
        ]);

        Subcategory::create([
            'name' => 'Revestimientos',
            'category_id' => $masonry->id
        ]);
    }
}
