<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $map = [
            'Desarrollo Web' => ['Frontend', 'Backend', 'Full Stack'],
            'Electrónica' => ['Robótica', 'Microcontroladores'],
            'Albañilería' => ['Estructuras', 'Revestimientos'],
        ];

        foreach ($map as $categoryName => $subcategories) {
            $category = Category::where('name', $categoryName)->first();

            foreach ($subcategories as $name) {
                Subcategory::create([
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}
