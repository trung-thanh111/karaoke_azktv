<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KaraokeHomepageSeeder extends Seeder
{
    private int $languageId = 1;
    private int $userId = 1;

    public function run(): void
    {
        $now = now();
        $this->userId = (int) (DB::table('users')->value('id') ?? 1);

        DB::table('slides')->updateOrInsert(
            ['keyword' => 'main-slide'],
            [
                'name' => 'Hero karaoke',
                'description' => 'Homepage hero',
                'item' => json_encode([
                    1 => [
                        [
                            'image' => '/uploads/images/thiet-ke/thiet-ke-phong-hop-01.jpg',
                            'name' => 'Thiết kế & Thi Công',
                            'description' => "Từ ý tưởng, thiết kế 3D, cách âm, nội thất, âm thanh ánh sáng.\nChúng tôi giúp bạn tạo nên phòng karaoke đẳng cấp, tối ưu chi phí và vận hành hiệu quả.",
                            'canonical' => '#',
                            'alt' => 'Phòng Karaoke Chuyên Nghiệp',
                            'window' => '',
                        ],
                    ],
                ], JSON_UNESCAPED_UNICODE),
                'setting' => json_encode([
                    'actions' => [
                        ['label' => 'Nhận báo giá miễn phí', 'url' => '#'],
                        ['label' => 'Xem các mẫu phòng', 'url' => '#'],
                    ],
                    'stats' => [
                        ['value' => '10+', 'label' => 'Năm kinh nghiệm'],
                        ['value' => '34+', 'label' => 'Tỉnh thành'],
                        ['value' => '10+', 'label' => 'Quốc gia'],
                        ['value' => '500+', 'label' => 'Dự án hoàn thành'],
                    ],
                ], JSON_UNESCAPED_UNICODE),
                'short_code' => '',
                'publish' => 2,
                'deleted_at' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('widgets')->updateOrInsert(
            ['keyword' => 'intro'],
            [
                'name' => 'Giới thiệu AZKTV',
                'description' => json_encode([
                    $this->languageId => [
                        'title' => 'AZKTV Việt Nam',
                        'subtitle' => 'Chuyên gia thiết kế phòng karaoke',
                        'body' => 'Chúng tôi cung cấp giải pháp thiết kế và thi công phòng karaoke trọn gói, từ tư vấn ý tưởng, thiết kế concept 3D đến thi công nội thất và lắp đặt hệ thống âm thanh - ánh sáng hoàn chỉnh. Với kinh nghiệm thực hiện hàng trăm phòng karaoke trên toàn quốc, đội ngũ của chúng tôi hiểu rõ cách tạo nên một không gian giải trí vừa đẹp, vừa hiệu quả trong vận hành kinh doanh.',
                        'features' => [
                            ['icon' => 'fa fa-trophy', 'label' => 'Kinh nghiệm thực tế'],
                            ['icon' => 'fa fa-cogs', 'label' => 'Thi công chuẩn kỹ thuật'],
                            ['icon' => 'fa fa-pencil-square-o', 'label' => 'Thiết kế sáng tạo'],
                            ['icon' => 'fa fa-line-chart', 'label' => 'Chi phí tối ưu'],
                        ],
                        'action' => ['label' => 'Xem thêm', 'url' => '#'],
                        'services' => [
                            ['icon' => 'fa fa-cube', 'label' => 'Thiết kế 3D'],
                            ['icon' => 'fa fa-volume-up', 'label' => 'Thi công cách âm'],
                            ['icon' => 'fa fa-bullseye', 'label' => 'Lắp đặt âm thanh'],
                            ['icon' => 'fa fa-object-group', 'label' => 'Ánh sáng & nội thất'],
                        ],
                    ],
                ], JSON_UNESCAPED_UNICODE),
                'album' => json_encode([
                    '/uploads/images/thiet-ke/thiet-ke-phong-khach-01.jpg',
                    '/uploads/images/thiet-ke/thiet-ke-phong-giam-doc-01.jpg',
                ], JSON_UNESCAPED_UNICODE),
                'model_id' => json_encode([]),
                'model' => 'StaticSection',
                'short_code' => '',
                'publish' => 2,
                'note' => 'Homepage intro section',
                'deleted_at' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        $constructionIds = $this->seedPosts([
            ['Luxury room', 'Mẫu phòng karaoke thi công theo concept sang trọng.', '/uploads/images/thiet-ke/thiet-ke-phong-khach-01.jpg'],
            ['Cyber room', 'Không gian karaoke ánh sáng hiện đại, tối ưu trải nghiệm.', '/uploads/images/thiet-ke/thiet-ke-phong-hop-01.jpg'],
            ['VIP karaoke', 'Phòng VIP hoàn thiện đồng bộ nội thất, âm thanh và ánh sáng.', '/uploads/images/thiet-ke/thiet-ke-phong-giam-doc-01.jpg'],
            ['VIP karaoke neon', 'Thi công phòng hát hiệu ứng neon nổi bật.', '/uploads/images/thiet-ke/thiet-ke-nha-hang-01.jpg'],
            ['Luxury room classic', 'Mẫu karaoke phong cách luxury phù hợp kinh doanh.', '/uploads/images/thiet-ke/thiet-ke-phong-ngu-01.jpg'],
            ['Cyber room pink', 'Không gian phòng hát trẻ trung với hệ đèn line.', '/uploads/images/thiet-ke/thiet-ke-biet-thu-01.jpg'],
            ['VIP karaoke galaxy', 'Trần sao và màn hình led tạo điểm nhấn cho phòng hát.', '/uploads/images/thiet-ke/thiet-ke-phong-lam-viec-01.jpg'],
            ['VIP karaoke lounge', 'Phòng karaoke kết hợp lounge vận hành hiệu quả.', '/uploads/images/thiet-ke/thiet-ke-phong-bep-01.jpg'],
        ]);

        $productIds = [277, 211, 136, 133, 128, 94, 85, 70];
        foreach ($productIds as $index => $productId) {
            DB::table('products')->where('id', $productId)->update(['order' => 1000 - $index]);
        }
        $designConsultingCatalogueId = 8;
        $designKaraokeCatalogueId = 23;
        $newsCatalogueIds = [
            'news' => 33,
            'experience' => 34,
            'faq' => 32,
        ];
        $designPostIds = [220, 293, 461, 252, 707, 703];
        $newsPostIds = [
            'news' => [708, 707, 701, 692, 684, 683, 679, 677],
            'experience' => [707, 692, 684, 683, 679, 677, 676, 675],
            'faq' => [639, 630, 629, 627, 626, 625, 603, 590],
        ];

        $this->prioritizePostsInCatalogue($designConsultingCatalogueId, $designPostIds);
        $this->prioritizePostsInCatalogue($designKaraokeCatalogueId, $designPostIds);
        foreach ($newsPostIds as $key => $ids) {
            $this->prioritizePostsInCatalogue($newsCatalogueIds[$key], $ids);
        }

        $this->upsertWidget('karaoke-construction', 'Thi công karaoke', 'Post', $constructionIds, [
            'title' => 'Thi công karaoke',
            'background' => '/userfiles/image/home/karaoke-section-bg.png',
        ], 'Homepage construction module section');

        $this->upsertWidget('featured-products', 'Sản phẩm nổi bật', 'Product', $productIds, [
            'title' => 'Sản phẩm nổi bật',
            'card_link_label' => 'Xem chi tiết',
            'action' => ['label' => 'Xem thêm', 'url' => '#'],
        ], 'Homepage featured product module section');

        $this->upsertWidget('home-designs', 'Tư vấn thiết kế karaoke', 'PostCatalogue', [$designConsultingCatalogueId, $designKaraokeCatalogueId], [
            'tabs' => [
                ['key' => 'consulting', 'label' => 'Tư vấn thiết kế', 'active' => true, 'ids' => [$designConsultingCatalogueId], 'post_ids' => $designPostIds],
                ['key' => 'karaoke-design', 'label' => 'Thiết kế karaoke', 'active' => false, 'ids' => [$designKaraokeCatalogueId], 'post_ids' => $designPostIds],
            ],
            'limit' => 6,
            'action' => ['label' => 'Xem thêm', 'url' => '#'],
        ], 'Homepage design consulting module section');

        $this->upsertWidget('home-news', 'Tin tức - kinh nghiệm - hỏi đáp', 'PostCatalogue', array_values($newsCatalogueIds), [
            'title' => 'Tin tức - Kinh nghiệm - Hỏi đáp',
            'columns' => [
                ['title' => 'Tin tức KTV', 'catalogue_id' => $newsCatalogueIds['news'], 'post_ids' => $newsPostIds['news'], 'limit' => 7],
                ['title' => 'Kinh nghiệm thi công', 'catalogue_id' => $newsCatalogueIds['experience'], 'post_ids' => $newsPostIds['experience'], 'limit' => 7],
                ['title' => 'Chuyên đề hỏi đáp', 'catalogue_id' => $newsCatalogueIds['faq'], 'post_ids' => $newsPostIds['faq'], 'limit' => 7],
            ],
        ], 'Homepage news experience faq module section');
    }

    private function seedPosts(array $items): array
    {
        $ids = [];
        foreach ($items as $index => [$name, $description, $image]) {
            $ids[] = $this->upsertPost($name, $description, $image, $index);
        }
        return $ids;
    }

    private function seedProducts(array $items): array
    {
        $ids = [];
        foreach ($items as $index => [$canonical, $name, $description, $image]) {
            $ids[] = $this->upsertProduct($canonical, $name, $description, $image, $index);
        }
        return $ids;
    }

    private function upsertPost(string $name, string $description, string $image, int $order): int
    {
        $now = now();
        $postId = DB::table('post_language')
            ->where('language_id', $this->languageId)
            ->where('name', $name)
            ->value('post_id');

        $payload = [
            'post_catalogue_id' => 0,
            'image' => $image,
            'album' => json_encode([]),
            'pubish' => 2,
            'order' => 1000 - $order,
            'user_id' => $this->userId,
            'deleted_at' => null,
            'updated_at' => $now,
        ];

        if ($postId) {
            DB::table('posts')->where('id', $postId)->update($payload);
        } else {
            $payload['created_at'] = $now;
            $postId = DB::table('posts')->insertGetId($payload);
        }

        DB::table('post_language')->updateOrInsert(
            ['post_id' => $postId, 'language_id' => $this->languageId],
            [
                'name' => $name,
                'description' => $description,
                'content' => $description,
                'meta_title' => $name,
                'meta_keyword' => $name,
                'meta_description' => $description,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        return (int) $postId;
    }

    private function upsertProduct(string $canonical, string $name, string $description, string $image, int $order): int
    {
        $now = now();
        $productId = DB::table('product_language')
            ->where('language_id', $this->languageId)
            ->where('canonical', $canonical)
            ->value('product_id');

        $payload = [
            'product_catalogue_id' => 0,
            'image' => $image,
            'album' => json_encode([]),
            'publish' => 2,
            'follow' => 2,
            'order' => 1000 - $order,
            'user_id' => $this->userId,
            'deleted_at' => null,
            'updated_at' => $now,
        ];

        if ($productId) {
            DB::table('products')->where('id', $productId)->update($payload);
        } else {
            $payload['created_at'] = $now;
            $productId = DB::table('products')->insertGetId($payload);
        }

        DB::table('product_language')->updateOrInsert(
            ['product_id' => $productId, 'language_id' => $this->languageId],
            [
                'name' => $name,
                'description' => $description,
                'content' => $description,
                'meta_title' => $name,
                'meta_keyword' => $name,
                'meta_description' => $description,
                'canonical' => $canonical,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        return (int) $productId;
    }

    private function upsertWidget(string $keyword, string $name, string $model, array $modelIds, array $description, string $note): void
    {
        $now = now();
        DB::table('widgets')->updateOrInsert(
            ['keyword' => $keyword],
            [
                'name' => $name,
                'description' => json_encode([$this->languageId => $description], JSON_UNESCAPED_UNICODE),
                'album' => json_encode([]),
                'model_id' => json_encode(array_values($modelIds)),
                'model' => $model,
                'short_code' => '',
                'publish' => 2,
                'note' => $note,
                'deleted_at' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );
    }

    private function prioritizePostsInCatalogue(int $catalogueId, array $postIds): void
    {
        foreach (array_values($postIds) as $index => $postId) {
            DB::table('posts')->where('id', $postId)->update([
                'pubish' => 2,
                'order' => 10000 - $index,
                'deleted_at' => null,
            ]);

            DB::table('post_catalogue_post')->updateOrInsert(
                [
                    'post_id' => $postId,
                    'post_catalogue_id' => $catalogueId,
                ]
            );
        }
    }
}
