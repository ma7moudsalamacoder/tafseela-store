<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Core\Models\Color;

class ColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['key' => '#FFFFFF', 'labels' => ['ar' => 'أبيض', 'en' => 'White']],
            ['key' => '#000000', 'labels' => ['ar' => 'أسود', 'en' => 'Black']],
            ['key' => '#FF0000', 'labels' => ['ar' => 'أحمر', 'en' => 'Red']],
            ['key' => '#0000FF', 'labels' => ['ar' => 'أزرق', 'en' => 'Blue']],
            ['key' => '#008000', 'labels' => ['ar' => 'أخضر', 'en' => 'Green']],
            ['key' => '#FFFF00', 'labels' => ['ar' => 'أصفر', 'en' => 'Yellow']],
            ['key' => '#808080', 'labels' => ['ar' => 'رمادي', 'en' => 'Grey']],
            ['key' => '#A52A2A', 'labels' => ['ar' => 'بني', 'en' => 'Brown']],
            ['key' => '#F5F5DC', 'labels' => ['ar' => 'بيج', 'en' => 'Beige']],
            ['key' => '#000080', 'labels' => ['ar' => 'كحلي', 'en' => 'Navy Blue']],
            ['key' => '#FFD700', 'labels' => ['ar' => 'ذهبي', 'en' => 'Gold']],
            ['key' => '#C0C0C0', 'labels' => ['ar' => 'فضي', 'en' => 'Silver']],
            ['key' => '#FFC0CB', 'labels' => ['ar' => 'وردي', 'en' => 'Pink']],
            ['key' => '#FFA500', 'labels' => ['ar' => 'برتقالي', 'en' => 'Orange']],
            ['key' => '#800080', 'labels' => ['ar' => 'بنفسجي', 'en' => 'Purple']],
        ];

        foreach ($colors as $color) {
            Color::updateOrCreate(['key' => $color['key']], $color);
        }
    }
}
