<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $valores = [
            'Divulgación' => '#81C784',
            'Literatura' => '#4FC3F7',
            'Deportes' => '#FFB74D',
            'Hardware' => '#BA68C8',
            'Software' => '#E0E0E0'
        ];

        ksort($valores);

        foreach($valores as $nombre => $color) {
            Category::create([
                'nombre' => $nombre,
                'color' => $color,
            ]);
            // o Category::create(compact('nombre', 'color'));
        }
    }
}
