<?php

namespace Database\Seeders;

use Botble\ACL\Models\User;
use Botble\Base\Models\MetaBox as MetaBoxModel;
use Botble\Base\Supports\BaseSeeder;
use Botble\Blog\Models\Category;
use Botble\Blog\Models\CategoryTranslation;
use Botble\Blog\Models\Post;
use Botble\Blog\Models\PostTranslation;
use Botble\Blog\Models\Tag;
use Botble\Blog\Models\TagTranslation;
use Botble\Language\Models\LanguageMeta;
use Botble\Slug\Models\Slug;
use Faker\Factory;
use Html;
use Illuminate\Support\Str;
use RvMedia;
use SlugHelper;

class BlogSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->uploadFiles('news');

        Post::truncate();
        Category::truncate();
        Tag::truncate();
        PostTranslation::truncate();
        CategoryTranslation::truncate();
        TagTranslation::truncate();
        Slug::where('reference_type', Post::class)->delete();
        Slug::where('reference_type', Tag::class)->delete();
        Slug::where('reference_type', Category::class)->delete();
        MetaBoxModel::where('reference_type', Post::class)->delete();
        MetaBoxModel::where('reference_type', Tag::class)->delete();
        MetaBoxModel::where('reference_type', Category::class)->delete();
        LanguageMeta::where('reference_type', Post::class)->delete();
        LanguageMeta::where('reference_type', Tag::class)->delete();
        LanguageMeta::where('reference_type', Category::class)->delete();

        $faker = Factory::create();

        $posts = [
            [
                'name' => 'Why people choose listio for own properties',
            ],
            [
                'name' => 'List of benifits and impressive listeo services',
            ],
            [
                'name' => 'What People Says About Listio Properties',
            ],
            [
                'name' => 'Why People Choose Listio For Own Properties',
            ],
            [
                'name' => 'List Of Benifits And Impressive Listeo Services',
            ],
            [
                'name' => 'What People Says About Listio Properties',
            ],
            [
                'name' => '5 of the Most Searched Outdoor Decor Trends of Summer 2021',
            ],
            [
                'name' => 'Crave a Canopy Bed? Modern Spins on This Dramatic Style',
            ],
            [
                'name' => 'The Property Brothers Reveal One Thing Never, Ever To Do to an Old House',
            ],
            [
                'name' => 'How to Build a Raised Herb Garden With Pallets',
            ],
            [
                'name' => 'Entertain in Style: 14 Products Made for an Outdoor Summer Soiree',
            ],
            [
                'name' => '6 Summer Maintenance Tasks That Could Save You Cash???Have You Done Them All?',
            ],
            [
                'name' => 'Average U.S. Rental Price Hits a Two-Year High',
            ],
            [
                'name' => 'Digital Land Rush Has People Spending Big Money on Virtual Real Estate. But Why?',
            ],
            [
                'name' => 'The Best State To Live In Right Now Is a Huge Surprise: Can You Guess?',
            ],
            [
                'name' => 'High Lumber Prices and Other Barriers Choke the Confidence of Home Builders and Home Buyers',
            ],
        ];
        $translationsPost = [
            [
                'name' => 'Gi???i ?????u t?? d?? ch???ng v???i th??? tr?????ng nh?? ?????t',
            ],
            [
                'name' => 'Th???i ?????i d???ch, mua nh?? h???ng sang ???????c h?????ng ti???n ??ch y t??? cao c???p ???trong m?????',
            ],
            [
                'name' => 'N?? b???t ???n ch??nh tr???, ng?????i gi??u H???ng K??ng ??ua nhau sang London ???s??n??? nh??',
            ],
            [
                'name' => 'Nhu c???u mua nh?? ??a th??? h??? ??? M??? gia t??ng v?? Covid',
            ],
            [
                'name' => 'Gi?? nh?? Anh ???????c d??? b??o t??ng 21% trong 5 n??m t???i',
            ],
            [
                'name' => 'V???c xin Covid ??? ???Ph??p m??u??? gi??p B??S b??n l??? H???ng K??ng v?????t qua s??ng gi???',
            ],
            [
                'name' => 'Gi???i si??u gi??u ????? x?? t??m mua ?????o ri??ng l??m n??i tr??nh Covid',
            ],
            [
                'name' => 'Doanh s??? b??n b???t ?????ng s???n h???ng sang New York ph???c h???i m???nh m???',
            ],
            [
                'name' => 'Th?????ng H???i ra lu???t ch???n ???chi??u??? ly h??n gi??? ????? h?????ng ??u ????i mua nh??',
            ],
            [
                'name' => 'D??n ?????u t?? t??ch c???c ??i ???s??n??? nh?? ?????t gi?? m???m ??? v??ng ph??? c???n',
            ],
            [
                'name' => 'D??? ??n An Ph?????c Riverside Phan Thi???t ???g??y s???t??? th??? tr?????ng B??S',
            ],
            [
                'name' => 'H???i M??i gi???i B??S Vi???t Nam c??ng b??? k???t qu??? b??nh ch???n v??ng 1 gi???i th?????ng n??m 2021',
            ],
            [
                'name' => 'S??n La s??? c?? khu ???? th??? ph??a T??y Nam r???ng 124ha',
            ],
            [
                'name' => 'B?? R???a - V??ng T??u mu???n x??y s??n bay G?? G??ng quy m?? 248ha',
            ],
            [
                'name' => 'B???t ?????ng s???n ?????o v?? quy ho???ch h??? t???ng t???o n??n s???c h??t cho ????ng S??i G??n',
            ],
            [
                'name' => '??i???m n??ng m???i c???a B??S h???p l???c m???nh d??ng ti???n ?????u t?? d?? ?????i d???ch',
            ],
        ];

        $categories = [
            [
                'name' => 'Latest news',
            ],
            [
                'name' => 'House architecture',
            ],
            [
                'name' => 'House design',
            ],
            [
                'name' => 'Building materials',
            ],
        ];

        $translationsCategory = [
            [
                'name' => 'Tin t???c m???i nh???t',
            ],
            [
                'name' => 'Ki???n tr??c nh??',
            ],
            [
                'name' => 'Thi???t k??? nh??',
            ],
            [
                'name' => 'V???t li???u x??y d???ng',
            ],
        ];

        $tags = [
            [
                'name' => 'General',
            ],
            [
                'name' => 'Design',
            ],
            [
                'name' => 'Fashion',
            ],
            [
                'name' => 'Branding',
            ],
            [
                'name' => 'Modern',
            ],
        ];
        $translationsTag = [
            [
                'name' => 'Chung',
            ],
            [
                'name' => 'Thi???t k???',
            ],
            [
                'name' => 'Th???i trang',
            ],
            [
                'name' => 'Th????ng hi???u',
            ],
            [
                'name' => 'Hi???n ?????i',
            ],
        ];

        foreach ($tags as $index => $item) {
            $item['author_id'] = 1;
            $item['author_type'] = User::class;
            $tag = Tag::create($item);

            Slug::create([
                'reference_type' => Tag::class,
                'reference_id'   => $tag->id,
                'key'            => Str::slug($tag->name),
                'prefix'         => SlugHelper::getPrefix(Tag::class),
            ]);
        }

        foreach ($translationsTag as $index => $item) {
            $item['lang_code'] = 'vi';
            $item['tags_id'] = $index + 1;
            TagTranslation::insert($item);
        }

        foreach ($categories as $index => $item) {
            $categoryDetail = Category::create([
                'name'      => $item['name'],
                'author_id' => 1,
            ]);

            Slug::create([
                'reference_type' => Category::class,
                'reference_id'   => $categoryDetail->id,
                'key'            => Str::slug($categoryDetail->name),
                'prefix'         => SlugHelper::getPrefix(Category::class),
            ]);
        }

        foreach ($translationsCategory as $index => $item) {
            $item['lang_code'] = 'vi';
            $item['categories_id'] = $index + 1;
            CategoryTranslation::insert($item);
        }


        foreach ($posts as $index => $item) {
            $item['content'] =
                ($index % 3 == 0 ? Html::tag(
                    'p',
                    '[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]'
                ) : '') .
                Html::tag('p', $faker->realText(1000)) .
                Html::tag(
                    'p',
                    Html::image(RvMedia::getImageUrl('news/' . $faker->numberBetween(1, 5) . '.jpg'))
                        ->toHtml(),
                    ['class' => 'text-center']
                ) .
                Html::tag('p', $faker->realText(500)) .
                Html::tag(
                    'p',
                    Html::image(RvMedia::getImageUrl('news/' . $faker->numberBetween(6, 10) . '.jpg'))
                        ->toHtml(),
                    ['class' => 'text-center']
                ) .
                Html::tag('p', $faker->realText(1000)) .
                Html::tag(
                    'p',
                    Html::image(RvMedia::getImageUrl('news/' . $faker->numberBetween(11, 14) . '.jpg'))
                        ->toHtml(),
                    ['class' => 'text-center']
                ) .
                Html::tag('p', $faker->realText(1000));
            $item['author_id'] = 1;
            $item['author_type'] = User::class;
            $item['views'] = $faker->numberBetween(100, 2500);
            $item['is_featured'] = $index < 9;
            $item['image'] = 'news/' . ($index + 1) . '.jpg';
            $item['description'] = $faker->text();
            $item['created_at'] = $faker->dateTimeBetween('-200 days');
            $post = Post::create($item);

            $post->categories()->sync([1, 2, 3, 4]);

            $post->tags()->sync([1, 2, 3, 4, 5]);
            $inserted[] = $post;
            Slug::create([
                'reference_type' => Post::class,
                'reference_id'   => $post->id,
                'key'            => Str::slug($post->name),
                'prefix'         => SlugHelper::getPrefix(Post::class),
            ]);
        }

        foreach ($translationsPost as $index => $item) {
            $item['lang_code'] = 'vi';
            $item['posts_id'] = $index + 1;
            $item['description'] = $inserted[$index]->description;
            $item['content'] = $inserted[$index]->content;
            PostTranslation::insert($item);
        }
    }
}
