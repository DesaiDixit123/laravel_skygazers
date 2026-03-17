<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Talent;

class TalentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $talents = [
            ['name' => 'SARAH L', 'category' => 'lifestyle', 'image' => null, 'label' => 'Lifestyle'],
            ['name' => 'MARCO R', 'category' => 'fashion', 'image' => null, 'label' => 'Fashion'],
            ['name' => 'ELENA K', 'category' => 'beauty', 'image' => null, 'label' => 'Beauty'],
            ['name' => 'DAVID W', 'category' => 'ugc', 'image' => null, 'label' => 'UGC Creator'],
            ['name' => 'SOFIA M', 'category' => 'lifestyle', 'image' => null, 'label' => 'Lifestyle'],
            ['name' => 'LUCAS P', 'category' => 'fashion', 'image' => null, 'label' => 'Fashion'],
            ['name' => 'ANNA S', 'category' => 'beauty', 'image' => null, 'label' => 'Beauty'],
            ['name' => 'CHRIS B', 'category' => 'ugc', 'image' => null, 'label' => 'UGC Creator'],
        ];

        foreach ($talents as $talent) {
            Talent::firstOrCreate(
                ['name' => $talent['name']],
                $talent
            );
        }
    }
}
