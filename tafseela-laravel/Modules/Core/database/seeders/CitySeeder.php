<?php

namespace Modules\Core\Database\Seeders;
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * - Egypt: all governorate capitals / major cities seeded.
     * - All other countries: top 5 major cities.
     *
     * Country IDs are resolved at runtime via country_code so the seeder is
     * environment-agnostic and does not rely on hardcoded auto-increment values.
     *
     * `city` is stored as JSON for i18n: {"en": "Cairo", "ar": "القاهرة"}
     */
    public function run(): void
    {
        /** @var array<string,int> $countryMap  country_code → id */
        $countryMap = DB::table('countries')
            ->pluck('id', 'country_code')
            ->all();

        $now  = Carbon::now();
        $rows = [];

        foreach ($this->getCities() as $countryCode => $cities) {
            if (! isset($countryMap[$countryCode])) {
                $this->command->warn("Country [{$countryCode}] not found in DB — skipping.");
                continue;
            }

            $countryId = $countryMap[$countryCode];

            foreach ($cities as $city) {
                $rows[] = [
                    'city'             => json_encode($city['city'], JSON_UNESCAPED_UNICODE),
                    'country_id'       => $countryId,
                    'user_location'    => $city['user_location'],
                    'serving_location' => $city['serving_location'],
                    'created_at'       => $now,
                    'updated_at'       => $now,
                ];
            }
        }

        foreach (array_chunk($rows, 100) as $chunk) {
            DB::table('cities')->insert($chunk);
        }

        $this->command->info('Cities seeded successfully (' . count($rows) . ' records).');
    }

    // -------------------------------------------------------------------------
    //  City data
    // -------------------------------------------------------------------------

    private function getCities(): array
    {
        return [

            // =================================================================
            // EGYPT — all 27 governorate capitals + major urban centres
            // =================================================================
            'EG' => [
                // Greater Cairo & surroundings
                ['city' => ['en' => 'Cairo',               'ar' => 'القاهرة'],          'user_location' => true,  'serving_location' => true],
                ['city' => ['en' => 'Giza',                'ar' => 'الجيزة'],           'user_location' => true,  'serving_location' => true],
                ['city' => ['en' => 'Shubra El Kheima',   'ar' => 'شبرا الخيمة'],     'user_location' => true,  'serving_location' => true],
                ['city' => ['en' => 'Helwan',              'ar' => 'حلوان'],            'user_location' => true,  'serving_location' => true],
                ['city' => ['en' => '6th of October City','ar' => 'مدينة السادس من أكتوبر'], 'user_location' => true, 'serving_location' => true],
                ['city' => ['en' => 'New Cairo',           'ar' => 'القاهرة الجديدة'], 'user_location' => true,  'serving_location' => true],
                ['city' => ['en' => 'Nasr City',           'ar' => 'مدينة نصر'],       'user_location' => true,  'serving_location' => true],
                ['city' => ['en' => 'Maadi',               'ar' => 'المعادي'],          'user_location' => true,  'serving_location' => true],
                ['city' => ['en' => 'Zamalek',             'ar' => 'الزمالك'],          'user_location' => true,  'serving_location' => false],
                ['city' => ['en' => '10th of Ramadan City','ar' => 'مدينة العاشر من رمضان'], 'user_location' => true, 'serving_location' => false],
                // Alexandria & North Coast
                ['city' => ['en' => 'Alexandria',          'ar' => 'الإسكندرية'],      'user_location' => true,  'serving_location' => true],
                ['city' => ['en' => 'Borg El Arab',        'ar' => 'برج العرب'],        'user_location' => true,  'serving_location' => false],
                ['city' => ['en' => 'Marsa Matruh',        'ar' => 'مرسى مطروح'],      'user_location' => true,  'serving_location' => false],
                // Delta
                ['city' => ['en' => 'Tanta',               'ar' => 'طنطا'],             'user_location' => true,  'serving_location' => true],
                ['city' => ['en' => 'Mansoura',            'ar' => 'المنصورة'],         'user_location' => true,  'serving_location' => true],
                ['city' => ['en' => 'Zagazig',             'ar' => 'الزقازيق'],         'user_location' => true,  'serving_location' => true],
                ['city' => ['en' => 'Damietta',            'ar' => 'دمياط'],            'user_location' => true,  'serving_location' => false],
                ['city' => ['en' => 'Kafr El Sheikh',      'ar' => 'كفر الشيخ'],       'user_location' => true,  'serving_location' => false],
                ['city' => ['en' => 'Damanhur',            'ar' => 'دمنهور'],           'user_location' => true,  'serving_location' => false],
                ['city' => ['en' => 'Shibin El Kom',       'ar' => 'شبين الكوم'],      'user_location' => true,  'serving_location' => false],
                ['city' => ['en' => 'Banha',               'ar' => 'بنها'],             'user_location' => true,  'serving_location' => false],
                ['city' => ['en' => 'Mit Ghamr',           'ar' => 'ميت غمر'],         'user_location' => false, 'serving_location' => false],
                ['city' => ['en' => 'Sohag',               'ar' => 'سوهاج'],            'user_location' => true,  'serving_location' => false],
                // Canal Zone
                ['city' => ['en' => 'Port Said',           'ar' => 'بورسعيد'],         'user_location' => true,  'serving_location' => true],
                ['city' => ['en' => 'Suez',                'ar' => 'السويس'],           'user_location' => true,  'serving_location' => true],
                ['city' => ['en' => 'Ismailia',            'ar' => 'الإسماعيلية'],     'user_location' => true,  'serving_location' => false],
                // Upper Egypt
                ['city' => ['en' => 'Luxor',               'ar' => 'الأقصر'],           'user_location' => true,  'serving_location' => true],
                ['city' => ['en' => 'Aswan',               'ar' => 'أسوان'],            'user_location' => true,  'serving_location' => true],
                ['city' => ['en' => 'Asyut',               'ar' => 'أسيوط'],            'user_location' => true,  'serving_location' => false],
                ['city' => ['en' => 'Qena',                'ar' => 'قنا'],              'user_location' => true,  'serving_location' => false],
                ['city' => ['en' => 'Minya',               'ar' => 'المنيا'],           'user_location' => true,  'serving_location' => false],
                ['city' => ['en' => 'Beni Suef',           'ar' => 'بني سويف'],         'user_location' => true,  'serving_location' => false],
                ['city' => ['en' => 'Fayoum',              'ar' => 'الفيوم'],           'user_location' => true,  'serving_location' => false],
                // Red Sea & Sinai
                ['city' => ['en' => 'Hurghada',            'ar' => 'الغردقة'],          'user_location' => true,  'serving_location' => true],
                ['city' => ['en' => 'Sharm El Sheikh',     'ar' => 'شرم الشيخ'],       'user_location' => true,  'serving_location' => true],
                ['city' => ['en' => 'El Arish',            'ar' => 'العريش'],           'user_location' => true,  'serving_location' => false],
                ['city' => ['en' => 'El Tor',              'ar' => 'الطور'],            'user_location' => false, 'serving_location' => false],
            ],

            // =================================================================
            // GULF STATES
            // =================================================================

            'SA' => [
                ['city' => ['en' => 'Riyadh',  'ar' => 'الرياض'],            'user_location' => true, 'serving_location' => true],
                ['city' => ['en' => 'Jeddah',  'ar' => 'جدة'],               'user_location' => true, 'serving_location' => true],
                ['city' => ['en' => 'Mecca',   'ar' => 'مكة المكرمة'],       'user_location' => true, 'serving_location' => true],
                ['city' => ['en' => 'Medina',  'ar' => 'المدينة المنورة'],    'user_location' => true, 'serving_location' => true],
                ['city' => ['en' => 'Dammam',  'ar' => 'الدمام'],            'user_location' => true, 'serving_location' => true],
            ],

            'AE' => [
                ['city' => ['en' => 'Dubai',     'ar' => 'دبي'],      'user_location' => true, 'serving_location' => true],
                ['city' => ['en' => 'Abu Dhabi', 'ar' => 'أبوظبي'],  'user_location' => true, 'serving_location' => true],
                ['city' => ['en' => 'Sharjah',   'ar' => 'الشارقة'], 'user_location' => true, 'serving_location' => true],
                ['city' => ['en' => 'Al Ain',    'ar' => 'العين'],    'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Ajman',     'ar' => 'عجمان'],    'user_location' => true, 'serving_location' => false],
            ],

            'KW' => [
                ['city' => ['en' => 'Kuwait City', 'ar' => 'مدينة الكويت'], 'user_location' => true, 'serving_location' => true],
                ['city' => ['en' => 'Hawalli',     'ar' => 'حولي'],          'user_location' => true, 'serving_location' => true],
                ['city' => ['en' => 'Salmiya',     'ar' => 'السالمية'],      'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Farwaniya',   'ar' => 'الفروانية'],     'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Ahmadi',      'ar' => 'الأحمدي'],       'user_location' => true, 'serving_location' => false],
            ],

            'QA' => [
                ['city' => ['en' => 'Doha',      'ar' => 'الدوحة'],  'user_location' => true, 'serving_location' => true],
                ['city' => ['en' => 'Al Rayyan', 'ar' => 'الريان'],  'user_location' => true, 'serving_location' => true],
                ['city' => ['en' => 'Al Wakrah', 'ar' => 'الوكرة'],  'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Al Khor',   'ar' => 'الخور'],   'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Umm Salal', 'ar' => 'أم صلال'],'user_location' => false,'serving_location' => false],
            ],

            'BH' => [
                ['city' => ['en' => 'Manama',     'ar' => 'المنامة'],    'user_location' => true, 'serving_location' => true],
                ['city' => ['en' => 'Riffa',      'ar' => 'الرفاع'],     'user_location' => true, 'serving_location' => true],
                ['city' => ['en' => 'Muharraq',   'ar' => 'المحرق'],    'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Hamad Town', 'ar' => 'مدينة حمد'],'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Isa Town',   'ar' => 'مدينة عيسى'],'user_location' => false,'serving_location' => false],
            ],

            'OM' => [
                ['city' => ['en' => 'Muscat',  'ar' => 'مسقط'],  'user_location' => true, 'serving_location' => true],
                ['city' => ['en' => 'Salalah', 'ar' => 'صلالة'], 'user_location' => true, 'serving_location' => true],
                ['city' => ['en' => 'Sohar',   'ar' => 'صحار'],  'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Nizwa',   'ar' => 'نزوى'],  'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Sur',     'ar' => 'صور'],   'user_location' => false,'serving_location' => false],
            ],

            // =================================================================
            // LEVANT
            // =================================================================

            'JO' => [
                ['city' => ['en' => 'Amman',  'ar' => 'عمّان'],   'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Zarqa',  'ar' => 'الزرقاء'], 'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Irbid',  'ar' => 'إربد'],    'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Aqaba',  'ar' => 'العقبة'],  'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Russeifa','ar' => 'الرصيفة'],'user_location' => false,'serving_location' => false],
            ],

            'LB' => [
                ['city' => ['en' => 'Beirut',   'ar' => 'بيروت'],   'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Tripoli',  'ar' => 'طرابلس'],  'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Sidon',    'ar' => 'صيدا'],    'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Tyre',     'ar' => 'صور'],     'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Jounieh',  'ar' => 'جونية'],   'user_location' => false,'serving_location' => false],
            ],

            'IQ' => [
                ['city' => ['en' => 'Baghdad', 'ar' => 'بغداد'],  'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Basra',   'ar' => 'البصرة'],  'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Mosul',   'ar' => 'الموصل'],  'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Erbil',   'ar' => 'أربيل'],   'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Najaf',   'ar' => 'النجف'],   'user_location' => false,'serving_location' => false],
            ],

            'SY' => [
                ['city' => ['en' => 'Damascus',  'ar' => 'دمشق'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Aleppo',    'ar' => 'حلب'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Homs',      'ar' => 'حمص'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Latakia',   'ar' => 'اللاذقية'],'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Hama',      'ar' => 'حماة'],   'user_location' => false,'serving_location' => false],
            ],

            'YE' => [
                ['city' => ['en' => "Sana'a",  'ar' => 'صنعاء'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Aden',    'ar' => 'عدن'],     'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Taiz',    'ar' => 'تعز'],     'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Hodeidah','ar' => 'الحديدة'], 'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Ibb',     'ar' => 'إب'],      'user_location' => false,'serving_location' => false],
            ],

            'PS' => [
                ['city' => ['en' => 'Gaza',         'ar' => 'غزة'],          'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Ramallah',     'ar' => 'رام الله'],     'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Nablus',       'ar' => 'نابلس'],        'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Hebron',       'ar' => 'الخليل'],       'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Jenin',        'ar' => 'جنين'],         'user_location' => false,'serving_location' => false],
            ],

            // =================================================================
            // NORTH AFRICA
            // =================================================================

            'LY' => [
                ['city' => ['en' => 'Tripoli',   'ar' => 'طرابلس'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Benghazi',  'ar' => 'بنغازي'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Misrata',   'ar' => 'مصراتة'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Tobruk',    'ar' => 'طبرق'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Zawiya',    'ar' => 'الزاوية'], 'user_location' => false,'serving_location' => false],
            ],

            'TN' => [
                ['city' => ['en' => 'Tunis',   'ar' => 'تونس'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Sfax',    'ar' => 'صفاقس'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Sousse',  'ar' => 'سوسة'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Kairouan','ar' => 'القيروان'],'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Bizerte', 'ar' => 'بنزرت'],  'user_location' => false,'serving_location' => false],
            ],

            'DZ' => [
                ['city' => ['en' => 'Algiers',  'ar' => 'الجزائر العاصمة'],'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Oran',     'ar' => 'وهران'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Constantine','ar' => 'قسنطينة'],'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Annaba',   'ar' => 'عنابة'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Blida',    'ar' => 'البليدة'],  'user_location' => false,'serving_location' => false],
            ],

            'MA' => [
                ['city' => ['en' => 'Casablanca', 'ar' => 'الدار البيضاء'],'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Rabat',      'ar' => 'الرباط'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Fez',        'ar' => 'فاس'],      'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Marrakesh',  'ar' => 'مراكش'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Tangier',    'ar' => 'طنجة'],     'user_location' => false,'serving_location' => false],
            ],

            'SD' => [
                ['city' => ['en' => 'Khartoum',     'ar' => 'الخرطوم'],      'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Omdurman',     'ar' => 'أم درمان'],     'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Port Sudan',   'ar' => 'بورتسودان'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Kassala',      'ar' => 'كسلا'],         'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'El Obeid',     'ar' => 'الأبيض'],       'user_location' => false,'serving_location' => false],
            ],

            // =================================================================
            // EUROPE
            // =================================================================

            'GB' => [
                ['city' => ['en' => 'London',     'ar' => 'لندن'],       'user_location' => true, 'serving_location' => true],
                ['city' => ['en' => 'Birmingham', 'ar' => 'برمنغهام'],   'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Manchester', 'ar' => 'مانشستر'],    'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Glasgow',    'ar' => 'غلاسكو'],     'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Leeds',      'ar' => 'ليدز'],       'user_location' => false,'serving_location' => false],
            ],

            'DE' => [
                ['city' => ['en' => 'Berlin',    'ar' => 'برلين'],    'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Hamburg',   'ar' => 'هامبورغ'],  'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Munich',    'ar' => 'ميونخ'],    'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Cologne',   'ar' => 'كولونيا'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Frankfurt', 'ar' => 'فرانكفورت'],'user_location' => false,'serving_location' => false],
            ],

            'FR' => [
                ['city' => ['en' => 'Paris',     'ar' => 'باريس'],    'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Marseille', 'ar' => 'مرسيليا'],  'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Lyon',      'ar' => 'ليون'],     'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Toulouse',  'ar' => 'تولوز'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Nice',      'ar' => 'نيس'],      'user_location' => false,'serving_location' => false],
            ],

            'IT' => [
                ['city' => ['en' => 'Rome',   'ar' => 'روما'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Milan',  'ar' => 'ميلانو'], 'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Naples', 'ar' => 'نابولي'], 'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Turin',  'ar' => 'تورينو'], 'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Palermo','ar' => 'باليرمو'],'user_location' => false,'serving_location' => false],
            ],

            'ES' => [
                ['city' => ['en' => 'Madrid',    'ar' => 'مدريد'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Barcelona', 'ar' => 'برشلونة'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Valencia',  'ar' => 'فالنسيا'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Seville',   'ar' => 'إشبيلية'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Zaragoza',  'ar' => 'سرقسطة'],   'user_location' => false,'serving_location' => false],
            ],

            'NL' => [
                ['city' => ['en' => 'Amsterdam', 'ar' => 'أمستردام'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Rotterdam', 'ar' => 'روتردام'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'The Hague', 'ar' => 'لاهاي'],     'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Utrecht',   'ar' => 'أوتريخت'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Eindhoven', 'ar' => 'آيندهوفن'],  'user_location' => false,'serving_location' => false],
            ],

            'SE' => [
                ['city' => ['en' => 'Stockholm', 'ar' => 'ستوكهولم'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Gothenburg','ar' => 'غوتنبرغ'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Malmö',     'ar' => 'مالمو'],     'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Uppsala',   'ar' => 'أوبسالا'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Västerås',  'ar' => 'فاستيروس'],  'user_location' => false,'serving_location' => false],
            ],

            'NO' => [
                ['city' => ['en' => 'Oslo',      'ar' => 'أوسلو'],     'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Bergen',    'ar' => 'بيرغن'],     'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Trondheim', 'ar' => 'تروندهايم'], 'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Stavanger', 'ar' => 'ستافانغر'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Drammen',   'ar' => 'درامن'],     'user_location' => false,'serving_location' => false],
            ],

            'CH' => [
                ['city' => ['en' => 'Zurich',   'ar' => 'زيورخ'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Geneva',   'ar' => 'جنيف'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Basel',    'ar' => 'بازل'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Bern',     'ar' => 'برن'],     'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Lausanne', 'ar' => 'لوزان'],   'user_location' => false,'serving_location' => false],
            ],

            'BE' => [
                ['city' => ['en' => 'Brussels',  'ar' => 'بروكسل'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Antwerp',   'ar' => 'أنتويرب'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Ghent',     'ar' => 'غنت'],       'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Charleroi', 'ar' => 'شارلروا'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Liège',     'ar' => 'لييج'],      'user_location' => false,'serving_location' => false],
            ],

            'AT' => [
                ['city' => ['en' => 'Vienna',    'ar' => 'فيينا'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Graz',      'ar' => 'غراتس'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Linz',      'ar' => 'لينز'],     'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Salzburg',  'ar' => 'زالتسبورغ'],'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Innsbruck', 'ar' => 'إنسبروك'],  'user_location' => false,'serving_location' => false],
            ],

            'PL' => [
                ['city' => ['en' => 'Warsaw',  'ar' => 'وارسو'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Kraków',  'ar' => 'كراكوف'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Łódź',    'ar' => 'وودز'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Wrocław', 'ar' => 'فروتسواف'],'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Poznań',  'ar' => 'بوزنان'],  'user_location' => false,'serving_location' => false],
            ],

            'PT' => [
                ['city' => ['en' => 'Lisbon',  'ar' => 'لشبونة'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Porto',   'ar' => 'بورتو'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Braga',   'ar' => 'براغا'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Amadora', 'ar' => 'أمادورا'], 'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Setúbal', 'ar' => 'سيتوبال'], 'user_location' => false,'serving_location' => false],
            ],

            'GR' => [
                ['city' => ['en' => 'Athens',       'ar' => 'أثينا'],        'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Thessaloniki', 'ar' => 'سالونيك'],      'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Patras',       'ar' => 'باتراس'],       'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Heraklion',    'ar' => 'هيراكليون'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Larissa',      'ar' => 'لاريسا'],       'user_location' => false,'serving_location' => false],
            ],

            'TR' => [
                ['city' => ['en' => 'Istanbul', 'ar' => 'إسطنبول'],  'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Ankara',   'ar' => 'أنقرة'],    'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Izmir',    'ar' => 'إزمير'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Bursa',    'ar' => 'بورصة'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Antalya',  'ar' => 'أنطاليا'],  'user_location' => false,'serving_location' => false],
            ],

            'RU' => [
                ['city' => ['en' => 'Moscow',          'ar' => 'موسكو'],           'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Saint Petersburg','ar' => 'سانت بطرسبرغ'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Novosibirsk',     'ar' => 'نوفوسيبيرسك'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Yekaterinburg',   'ar' => 'يكاترينبورغ'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Kazan',           'ar' => 'قازان'],           'user_location' => false,'serving_location' => false],
            ],

            // =================================================================
            // AMERICAS
            // =================================================================

            'US' => [
                ['city' => ['en' => 'New York City', 'ar' => 'مدينة نيويورك'], 'user_location' => true, 'serving_location' => true],
                ['city' => ['en' => 'Los Angeles',   'ar' => 'لوس أنجلوس'],   'user_location' => true, 'serving_location' => true],
                ['city' => ['en' => 'Chicago',       'ar' => 'شيكاغو'],        'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Houston',       'ar' => 'هيوستن'],        'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Phoenix',       'ar' => 'فينيكس'],        'user_location' => false,'serving_location' => false],
            ],

            'CA' => [
                ['city' => ['en' => 'Toronto',   'ar' => 'تورنتو'],   'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Montreal',  'ar' => 'مونتريال'], 'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Vancouver', 'ar' => 'فانكوفر'],  'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Calgary',   'ar' => 'كالغاري'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Ottawa',    'ar' => 'أوتاوا'],   'user_location' => false,'serving_location' => false],
            ],

            'BR' => [
                ['city' => ['en' => 'São Paulo',    'ar' => 'ساو باولو'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Rio de Janeiro','ar' => 'ريو دي جانيرو'],'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Brasília',     'ar' => 'برازيليا'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Salvador',     'ar' => 'سالفادور'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Fortaleza',    'ar' => 'فورتاليزا'],   'user_location' => false,'serving_location' => false],
            ],

            'MX' => [
                ['city' => ['en' => 'Mexico City', 'ar' => 'مكسيكو سيتي'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Guadalajara', 'ar' => 'غوادالاخارا'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Monterrey',   'ar' => 'مونتيري'],      'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Puebla',      'ar' => 'بويبلا'],       'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Tijuana',     'ar' => 'تيخوانا'],      'user_location' => false,'serving_location' => false],
            ],

            'AR' => [
                ['city' => ['en' => 'Buenos Aires', 'ar' => 'بوينس آيرس'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Córdoba',      'ar' => 'قرطبة'],       'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Rosario',      'ar' => 'روساريو'],     'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Mendoza',      'ar' => 'ميندوزا'],     'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Tucumán',      'ar' => 'توكومان'],     'user_location' => false,'serving_location' => false],
            ],

            // =================================================================
            // ASIA & OCEANIA
            // =================================================================

            'IN' => [
                ['city' => ['en' => 'Mumbai',    'ar' => 'مومباي'],   'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Delhi',     'ar' => 'دلهي'],     'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Bangalore', 'ar' => 'بنغالور'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Hyderabad', 'ar' => 'حيدر آباد'],'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Chennai',   'ar' => 'تشيناي'],   'user_location' => false,'serving_location' => false],
            ],

            'CN' => [
                ['city' => ['en' => 'Shanghai',  'ar' => 'شنغهاي'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Beijing',   'ar' => 'بكين'],     'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Shenzhen',  'ar' => 'شنتشن'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Guangzhou', 'ar' => 'قوانغتشو'], 'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Chengdu',   'ar' => 'تشنغدو'],  'user_location' => false,'serving_location' => false],
            ],

            'JP' => [
                ['city' => ['en' => 'Tokyo',    'ar' => 'طوكيو'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Osaka',    'ar' => 'أوساكا'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Nagoya',   'ar' => 'ناغويا'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Sapporo',  'ar' => 'سابورو'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Fukuoka',  'ar' => 'فوكوكا'],   'user_location' => false,'serving_location' => false],
            ],

            'KR' => [
                ['city' => ['en' => 'Seoul',    'ar' => 'سيول'],     'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Busan',    'ar' => 'بوسان'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Incheon',  'ar' => 'إنتشون'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Daegu',    'ar' => 'دايغو'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Daejeon',  'ar' => 'دايجون'],   'user_location' => false,'serving_location' => false],
            ],

            'PK' => [
                ['city' => ['en' => 'Karachi',    'ar' => 'كراتشي'],    'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Lahore',     'ar' => 'لاهور'],     'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Islamabad',  'ar' => 'إسلام آباد'],'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Faisalabad', 'ar' => 'فيصل آباد'], 'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Rawalpindi', 'ar' => 'راولبندي'],  'user_location' => false,'serving_location' => false],
            ],

            'BD' => [
                ['city' => ['en' => 'Dhaka',       'ar' => 'دكا'],       'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Chittagong',  'ar' => 'شيتاغونغ'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Khulna',      'ar' => 'خولنا'],     'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Rajshahi',    'ar' => 'راجشاهي'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Sylhet',      'ar' => 'سيلهيت'],    'user_location' => false,'serving_location' => false],
            ],

            'PH' => [
                ['city' => ['en' => 'Manila',      'ar' => 'مانيلا'],     'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Quezon City', 'ar' => 'مدينة كيزون'],'user_location' => true, 'serving_location' => false],
                ['city' => ['en' => 'Cebu City',   'ar' => 'مدينة سيبو'], 'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Davao City',  'ar' => 'مدينة دافاو'],'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Zamboanga',   'ar' => 'زامبوانغا'],  'user_location' => false,'serving_location' => false],
            ],

            'ID' => [
                ['city' => ['en' => 'Jakarta',   'ar' => 'جاكرتا'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Surabaya',  'ar' => 'سورابايا'], 'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Bandung',   'ar' => 'باندونغ'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Medan',     'ar' => 'ميدان'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Semarang',  'ar' => 'سيمارانغ'], 'user_location' => false,'serving_location' => false],
            ],

            'MY' => [
                ['city' => ['en' => 'Kuala Lumpur', 'ar' => 'كوالالمبور'], 'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'George Town',  'ar' => 'جورج تاون'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Ipoh',          'ar' => 'إيبوه'],      'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Shah Alam',     'ar' => 'شاه عالم'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Johor Bahru',   'ar' => 'جوهور باهرو'],'user_location' => false,'serving_location' => false],
            ],

            'SG' => [
                ['city' => ['en' => 'Singapore',       'ar' => 'سنغافورة'],      'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Jurong East',     'ar' => 'جورونغ إيست'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Tampines',        'ar' => 'تامبينس'],       'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Woodlands',       'ar' => 'وودلاندز'],      'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Ang Mo Kio',      'ar' => 'أنغ مو كيو'],    'user_location' => false,'serving_location' => false],
            ],

            'TH' => [
                ['city' => ['en' => 'Bangkok',   'ar' => 'بانكوك'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Chiang Mai','ar' => 'شيانغ ماي'], 'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Pattaya',   'ar' => 'باتايا'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Hat Yai',   'ar' => 'هات ياي'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Phuket',    'ar' => 'فوكيت'],     'user_location' => false,'serving_location' => false],
            ],

            'AU' => [
                ['city' => ['en' => 'Sydney',    'ar' => 'سيدني'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Melbourne', 'ar' => 'ملبورن'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Brisbane',  'ar' => 'بريزبان'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Perth',     'ar' => 'بيرث'],     'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Adelaide',  'ar' => 'أديلايد'],  'user_location' => false,'serving_location' => false],
            ],

            'NZ' => [
                ['city' => ['en' => 'Auckland',      'ar' => 'أوكلاند'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Wellington',    'ar' => 'ولينغتون'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Christchurch',  'ar' => 'كرايستشيرش'],'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Hamilton',      'ar' => 'هاملتون'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Tauranga',      'ar' => 'تورانغا'],    'user_location' => false,'serving_location' => false],
            ],

            'IR' => [
                ['city' => ['en' => 'Tehran',   'ar' => 'طهران'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Mashhad',  'ar' => 'مشهد'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Isfahan',  'ar' => 'أصفهان'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Karaj',    'ar' => 'كرج'],     'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Tabriz',   'ar' => 'تبريز'],   'user_location' => false,'serving_location' => false],
            ],

            // =================================================================
            // AFRICA
            // =================================================================

            'ZA' => [
                ['city' => ['en' => 'Johannesburg', 'ar' => 'جوهانسبرغ'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Cape Town',    'ar' => 'كيب تاون'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Durban',       'ar' => 'ديربان'],      'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Pretoria',     'ar' => 'بريتوريا'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Port Elizabeth','ar' => 'بورت إليزابيث'],'user_location' => false,'serving_location' => false],
            ],

            'NG' => [
                ['city' => ['en' => 'Lagos',   'ar' => 'لاغوس'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Kano',    'ar' => 'كانو'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Ibadan',  'ar' => 'إيبادان'], 'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Abuja',   'ar' => 'أبوجا'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Benin City','ar' => 'مدينة بنين'],'user_location' => false,'serving_location' => false],
            ],

            'KE' => [
                ['city' => ['en' => 'Nairobi',  'ar' => 'نيروبي'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Mombasa',  'ar' => 'مومباسا'], 'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Kisumu',   'ar' => 'كيسومو'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Nakuru',   'ar' => 'ناكورو'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Eldoret',  'ar' => 'إلدوريت'], 'user_location' => false,'serving_location' => false],
            ],

            'ET' => [
                ['city' => ['en' => 'Addis Ababa', 'ar' => 'أديس أبابا'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Dire Dawa',   'ar' => 'ديري داوا'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Mekelle',     'ar' => 'مقلي'],         'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Gondar',      'ar' => 'غوندار'],       'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Hawassa',     'ar' => 'هواسا'],        'user_location' => false,'serving_location' => false],
            ],

            'GH' => [
                ['city' => ['en' => 'Accra',     'ar' => 'أكرا'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Kumasi',    'ar' => 'كوماسي'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Tamale',    'ar' => 'تمالي'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Takoradi',  'ar' => 'تاكورادي'],'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Cape Coast','ar' => 'كيب كوست'],'user_location' => false,'serving_location' => false],
            ],

            'SO' => [
                ['city' => ['en' => 'Mogadishu',  'ar' => 'مقديشو'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Hargeisa',   'ar' => 'هرجيسا'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Kismayo',    'ar' => 'كيسمايو'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Bosaso',     'ar' => 'بوصاصو'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Merca',      'ar' => 'مرقة'],     'user_location' => false,'serving_location' => false],
            ],

            'MR' => [
                ['city' => ['en' => 'Nouakchott',  'ar' => 'نواكشوط'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Nouadhibou',  'ar' => 'نواذيبو'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Kiffa',       'ar' => 'كيفه'],      'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Rosso',       'ar' => 'روسو'],      'user_location' => false,'serving_location' => false],
                ['city' => ['en' => "Zouérate",    'ar' => 'زويرات'],    'user_location' => false,'serving_location' => false],
            ],

            'DJ' => [
                ['city' => ['en' => 'Djibouti City', 'ar' => 'مدينة جيبوتي'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Ali Sabieh',    'ar' => 'علي صبيح'],       'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Tadjourah',     'ar' => 'تاجورة'],         'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Obock',         'ar' => 'عوبوك'],          'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Dikhil',        'ar' => 'دخيل'],           'user_location' => false,'serving_location' => false],
            ],

            'KM' => [
                ['city' => ['en' => 'Moroni',      'ar' => 'موروني'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Mutsamudu',   'ar' => 'موتساموضو'], 'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Fomboni',     'ar' => 'فومبوني'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Domoni',      'ar' => 'دوموني'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Tsimbeo',     'ar' => 'تسيمبيو'],   'user_location' => false,'serving_location' => false],
            ],

            // =================================================================
            // CENTRAL & SOUTH ASIA
            // =================================================================

            'AF' => [
                ['city' => ['en' => 'Kabul',     'ar' => 'كابول'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Kandahar',  'ar' => 'قندهار'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Herat',     'ar' => 'هرات'],     'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Mazar-i-Sharif','ar' => 'مزار شريف'],'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Jalalabad', 'ar' => 'جلال آباد'],'user_location' => false,'serving_location' => false],
            ],

            'KZ' => [
                ['city' => ['en' => 'Almaty',   'ar' => 'ألماتي'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Nur-Sultan','ar' => 'نور سلطان'],'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Shymkent', 'ar' => 'شيمكنت'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Karaganda','ar' => 'قراغاندا'], 'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Aktobe',   'ar' => 'أكتوبي'],   'user_location' => false,'serving_location' => false],
            ],

            'UZ' => [
                ['city' => ['en' => 'Tashkent',  'ar' => 'طشقند'],    'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Samarkand', 'ar' => 'سمرقند'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Namangan',  'ar' => 'نمنغان'],   'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Andijan',   'ar' => 'أنديجان'],  'user_location' => false,'serving_location' => false],
                ['city' => ['en' => 'Bukhara',   'ar' => 'بخارى'],    'user_location' => false,'serving_location' => false],
            ],

        ];
    }
}