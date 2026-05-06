<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Core\Models\SiteSetting;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'contacts',
                'value' => [
                    'address' => 'الأسكندرية - مصر',
                    'phone' => '+20 123 456 7890',
                    'email' => 'care@tafseela.net',
                    'facebook' => '#',
                    'instagram' => '#',
                    'twitter' => '#',
                    'footer_slogan' => ' متجركم الأول للأزياء العصرية المصممة بدقة لتلائم أسلوب حياتكم. الجودة والفخامة في كل غرزة منذ عام 2020. ',
                ],
            ],
            [
                'key' => 'hero',
                'value' => [
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAtKicfpnDGxV6OZ2AcKbavKPy2wiKTHJpXSR_qEVlqnyuzIWeOETtGbC1_xTCE3wiEs37Je1VvyoWrDgJlz4-W0sOonxdwLSRtNxXrYspmmROYfEJ9Bgx31eWI7Aha_atd1OG0Q6EAEIuvh7oHir9DLMvuPUNLiVe2XwNwWYuAOtONslDp2u_F7V9pMFNeviQfyvM92F3CZlvlpUvctZJLIOB_tmP_EKmLrmB26IrTo3Lm4KX8ty7bDv3v09A3LtqGyo_7BJUoin53',
                    'badge' => 'مجموعة خريف وشتاء 2026',
                    'description' => 'اكتشفوا أحدث التصاميم العصرية التي تجمع بين الأصالة والراحة. قطع حصرية صممت لتعكس شخصيتكم الراقية.',
                    'collectionSlug' => 'winter-2024',
                ],
            ],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
