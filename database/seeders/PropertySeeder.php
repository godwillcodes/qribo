<?php

namespace Database\Seeders;

use Botble\Base\Models\MetaBox as MetaBoxModel;
use Botble\Base\Supports\BaseSeeder;
use Botble\Language\Models\LanguageMeta;
use Botble\RealEstate\Enums\ModerationStatusEnum;
use Botble\RealEstate\Models\Account;
use Botble\RealEstate\Models\Property;
use Botble\RealEstate\Models\PropertyTranslation;
use Botble\Slug\Models\Slug;
use Faker\Factory;
use Faker\Provider\en_US\Address;
use Html;
use Illuminate\Support\Str;
use MetaBox;
use RvMedia;
use SlugHelper;

class PropertySeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->uploadFiles('properties');

        Property::truncate();
        PropertyTranslation::truncate();
        Slug::where('reference_type', Property::class)->delete();
        MetaBoxModel::where('reference_type', Property::class)->delete();
        LanguageMeta::where('reference_type', Property::class)->delete();

        $faker = Factory::create('en_US');
        $faker->addProvider(new Address($faker));

        $properties = [
            [
                'name'          => '6007 Applegate Lane',
                'header_layout' => 'layout-1',
                'coordinates'   => [
                    'lat' => 38.1343013,
                    'lng' => -85.6498512,
                ],
            ],
            [
                'name'          => '2721 Lindsay Avenue',
                'header_layout' => 'layout-2',
                'coordinates'   => [
                    'lat' => 38.263793,
                    'lng' => -85.700243,
                ],
            ],
            [
                'name'          => '2203 7th Street Road',
                'header_layout' => 'layout-3',
                'coordinates'   => [
                    'lat' => 38.142768,
                    'lng' => -85.7717132,
                ],
            ],
            [
                'name'        => '7431 Candace Way',
                'coordinates' => [
                    'lat' => 44.771005,
                    'lng' => -72.048664,
                ],
            ],
            [
                'name'        => '8502 Madrone Avenue',
                'coordinates' => [
                    'lat' => 38.1286407,
                    'lng' => -85.8678042,
                ],
            ],
            [
                'name'        => '1745 T Street Southeast',
                'coordinates' => [
                    'lat' => 38.867033,
                    'lng' => -76.979235,
                ],
            ],
            [
                'name'        => '81 Seaton Place Northwest',
                'coordinates' => [
                    'lat' => 38.9149499,
                    'lng' => -77.01170259999999,
                ],
            ],
            [
                'name'        => '802 Madison Street Northwest',
                'coordinates' => [
                    'lat' => 38.9582381,
                    'lng' => -77.0244287,
                ],
            ],
            [
                'name'        => '2811 Battery Place Northwest',
                'coordinates' => [
                    'lat' => 38.9256252,
                    'lng' => -77.0982646,
                ],
            ],
            [
                'name'        => '1508 Massachusetts Avenue Southeast',
                'coordinates' => [
                    'lat' => 38.887255,
                    'lng' => -76.98318499999999,
                ],
            ],
            [
                'name'        => '1427 South Carolina Avenue Southeast',
                'coordinates' => [
                    'lat' => 38.886615,
                    'lng' => -76.9845349,
                ],
            ],
            [
                'name'        => '127 Grand Heron Drive',
                'coordinates' => [
                    'lat' => 30.189702,
                    'lng' => -85.80841099999999,
                ],
            ],
            [
                'name'        => '1515 Chandlee Avenue',
                'coordinates' => [
                    'lat' => 30.176365,
                    'lng' => -85.666253,
                ],
            ],
            [
                'name'        => '4113 Holiday Drive',
                'coordinates' => [
                    'lat' => 30.1548681,
                    'lng' => -85.7709976,
                ],
            ],
            [
                'name'        => '545 Tracey Drive',
                'coordinates' => [
                    'lat' => 30.1354251,
                    'lng' => -85.5573034,
                ],
            ],
            [
                'name'        => '2318 Camryns Crossing',
                'coordinates' => [
                    'lat' => 30.221926,
                    'lng' => -85.62420000000002,
                ],
            ],
            [
                'name'        => '1025 West 19th Street',
                'coordinates' => [
                    'lat' => 30.18252889999999,
                    'lng' => -85.676771,
                ],
            ],
        ];
        $translations = [
            [
                'name' => 'C??n h??? The Sun Avenue',
            ],
            [
                'name' => 'B??n nh?? m???t ti???n L?? V??n L????ng, Nh?? B??',
            ],
            [
                'name' => 'B??n nh?? 3 t???ng m???t ti???n ???????ng 3/2',
            ],
            [
                'name' => 'B??n bi???t th??? Galleria Nguy???n H???u Th???',
            ],
            [
                'name' => 'B??n c??n h??? The Marq 1PN',
            ],
            [
                'name' => 'M???t ti???n ???????ng 3/2, Qu???n 11',
            ],
            [
                'name' => 'B??n c??n h??? Gateway Th???o ??i???n',
            ],
            [
                'name' => 'C??n h??? Celadon City',
            ],
            [
                'name' => 'Vinhomes Central Park',
            ],
            [
                'name' => 'Nh?? ph??? t???i KDC Aeon',
            ],
            [
                'name' => 'C??n h??? Chung c?? 41Bis ??BP',
            ],
            [
                'name' => 'Nh?? ph??? h???m xe h??i.',
            ],
            [
                'name' => 'C??n h??? Sunwah Pearl',
            ],
            [
                'name' => 'C??n h??? Vinhomes Central Park',
            ],
            [
                'name' => 'C??n h??? One Verandah t???ng trung',
            ],
            [
                'name' => 'Officetel The Sun Avenue',
            ],
            [
                'name' => 'Maia Resort',
            ],
        ];

        foreach ($properties as $index => $item) {
            $item['content'] =
                ($index % 3 == 0 ? Html::tag(
                    'p',
                    '[youtube-video]https://www.youtube.com/watch?v=U05fwua9-D4[/youtube-video]'
                ) : '') .
                Html::tag('p', $faker->realText(1000)) .
                Html::tag(
                    'p',
                    Html::image(RvMedia::getImageUrl(
                        'properties/p-' . $faker->numberBetween(1, 7) . '.jpg',
                        'medium'
                    ))
                        ->toHtml(),
                    ['class' => 'text-center']
                ) .
                Html::tag('p', $faker->realText(500)) .
                Html::tag(
                    'p',
                    Html::image(RvMedia::getImageUrl(
                        'properties/p-' . $faker->numberBetween(8, 15) . '.jpg',
                        'medium'
                    ))
                        ->toHtml(),
                    ['class' => 'text-center']
                ) .
                Html::tag('p', $faker->realText(1000)) .
                Html::tag(
                    'p',
                    Html::image(RvMedia::getImageUrl(
                        'properties/p-' . $faker->numberBetween(15, 20) . '.jpg',
                        'medium'
                    ))
                        ->toHtml(),
                    ['class' => 'text-center']
                ) .
                Html::tag('p', $faker->realText(1000));
            $item['author_id'] = 1;
            $item['author_type'] = Account::class;
            $item['is_featured'] = 1;
            $item['description'] = $faker->text();
            $item['location'] = $faker->address;
            $item['number_bedroom'] = $faker->numberBetween(1, 5);
            $item['number_bathroom'] = $faker->numberBetween(1, 5);
            $item['number_floor'] = $faker->numberBetween(1, 5);
            $item['square'] = $faker->numberBetween(50, 500);
            $item['price'] = $faker->numberBetween(5000, 500000);
            $item['currency_id'] = 1;
            $item['never_expired'] = 1;
            $item['type_id'] = $faker->numberBetween(1, 2);
            $item['city_id'] = $faker->numberBetween(1, 6);
            $item['category_id'] = $faker->numberBetween(1, 6);
            $item['moderation_status'] = ModerationStatusEnum::APPROVED;
            $item['latitude'] = isset($item['coordinates']) ? $item['coordinates']['lat'] : $faker->latitude;
            $item['longitude'] = isset($item['coordinates']) ? $item['coordinates']['lng'] : $faker->longitude;
            $item['author_id'] = Account::inRandomOrder()->value('id');
            $item['author_type'] = Account::class;

            $images = [];
            for ($i = 0; $i < 5; $i++) {
                $images[] = 'properties/p-' . $faker->numberBetween(1, 20) . '.jpg';
            }

            $item['images'] = json_encode($images);

            $headerLayout = isset($item['header_layout']) ? $item['header_layout'] : false;
            unset($item['header_layout']);
            unset($item['coordinates']);

            $property = Property::create($item);

            $property->features()->sync([
                $faker->numberBetween(1, 5),
                $faker->numberBetween(5, 12),
            ]);

            $property->facilities()->detach();
            $property->facilities()->attach($faker->numberBetween(1, 5), ['distance' => rand(1, 20) . 'km']);
            $property->facilities()->attach($faker->numberBetween(6, 12), ['distance' => rand(1, 20) . 'km']);

            if ($headerLayout) {
                MetaBox::saveMetaBoxData($property, 'header_layout', $headerLayout);
            }

            MetaBox::saveMetaBoxData($property, 'video_url', $faker->randomElement([
                'https://www.youtube.com/watch?v=U05fwua9-D4',
                'https://www.youtube.com/watch?v=0I647GU3Jsc',
            ]));

            Slug::create([
                'reference_type' => Property::class,
                'reference_id'   => $property->id,
                'key'            => Str::slug($property->name),
                'prefix'         => SlugHelper::getPrefix(Property::class),
            ]);
        }

        foreach ($translations as $index => $item) {
            $content =
                ($index % 3 == 0 ? Html::tag(
                    'p',
                    '[youtube-video]https://www.youtube.com/watch?v=U05fwua9-D4[/youtube-video]'
                ) : '') .
                Html::tag('p', $faker->realText(1000)) .
                Html::tag(
                    'p',
                    Html::image(RvMedia::getImageUrl(
                        'properties/p-' . $faker->numberBetween(1, 7) . '.jpg',
                        'medium'
                    ))
                        ->toHtml(),
                    ['class' => 'text-center']
                ) .
                Html::tag('p', $faker->realText(500)) .
                Html::tag(
                    'p',
                    Html::image(RvMedia::getImageUrl(
                        'properties/p-' . $faker->numberBetween(8, 15) . '.jpg',
                        'medium'
                    ))
                        ->toHtml(),
                    ['class' => 'text-center']
                ) .
                Html::tag('p', $faker->realText(1000)) .
                Html::tag(
                    'p',
                    Html::image(RvMedia::getImageUrl(
                        'properties/p-' . $faker->numberBetween(15, 20) . '.jpg',
                        'medium'
                    ))
                        ->toHtml(),
                    ['class' => 'text-center']
                ) .
                Html::tag('p', $faker->realText(1000));
            PropertyTranslation::insert([
                're_properties_id' => $index + 1,
                'lang_code'        => 'vi',
                'name'             => $item['name'],
                'description'      => $faker->text(),
                'content'          => $content,
                'location'         => $faker->address
            ]);
        }
    }
}
