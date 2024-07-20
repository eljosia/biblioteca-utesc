<?php

namespace Database\Seeders;

use App\Models\Careers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CareerIconSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Careers::where('name', 'Mantenimiento')->update(['icon' => 'https://cdn-icons-png.flaticon.com/512/4360/4360309.png']);
        Careers::where('name', 'Tecnologías')->update(['icon' => 'https://cdn-icons-png.flaticon.com/512/12444/12444004.png']);
        Careers::where('name', 'Gastronomía')->update(['icon' => 'https://cdn-icons-png.flaticon.com/512/2858/2858653.png']);
        Careers::where('name', 'Agricultura')->update(['icon' => 'https://cdn-icons-png.flaticon.com/512/1892/1892747.png']);
        Careers::where('name', 'Enfermería')->update(['icon' => 'https://cdn-icons-png.flaticon.com/512/3567/3567412.png']);
        Careers::where('name', 'Procesos Bioalimentarios')->update(['icon' => 'https://cdn-icons-png.flaticon.com/512/2720/2720357.png']);
        Careers::where('name', 'Turismo')->update(['icon' => 'https://cdn-icons-png.flaticon.com/512/4283/4283171.png']);
        Careers::where('name', 'Infantiles')->update(['icon' => 'https://cdn-icons-png.flaticon.com/512/8973/8973444.png']);
        Careers::where('name', 'Mecatrónica')->update(['icon' => 'https://cdn-icons-png.flaticon.com/512/1693/1693820.png']);
        Careers::where('name', 'Otros')->update(['icon' => 'https://cdn-icons-png.flaticon.com/512/3330/3330317.png']);

    }
}
