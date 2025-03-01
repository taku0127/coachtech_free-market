<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LikesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    // 各テスト前に実行される
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh'); //  IDの自動採番をリセット
        $this->seed(); // シーダー実行
    }
    public function testLikes()
    {
        // いいねができる&いいねをするとアイコンの色が変わる
        $user = User::first();
        $this->actingAs($user);

        $response = $this->get('/item/1');
        $response->assertStatus(200);

        // いいねがついてなければ、色は変わらない(--activeがついていない)
        $response->assertDontSee('<button class="p-item-detail_icon_img --active">',false);

        // いいねをする
        $response = $this->followingRedirects()->post('/like',['product_id' => 1]);
        // いいねの登録確認
        $this->assertDatabaseHas('likes',[
            'user_id' => $user->id,
            'product_id' => 1,
        ]);
        // いいね数が1になる(コメントは０)
        $response->assertSeeInOrder(['<div class="p-item-detail_icon_count">1</div>','<div class="p-item-detail_icon_count">0</div>'],false);

        // いいねがつくとアイコンの色が変わる(クラスのp-item-detail_icon_img に --activeクラスがつくと色が変わる)
        $response->assertSee('<button class="p-item-detail_icon_img --active">',false);
    }

    public function testLikesCancell(){
        $user = User::first();
        $this->actingAs($user);

        $response = $this->get('/item/1');
        $response->assertStatus(200);

        // いいねをする
        $response = $this->followingRedirects()->post('/like',['product_id' => 1]);
        // いいねの登録確認
        $this->assertDatabaseHas('likes',[
            'user_id' => $user->id,
            'product_id' => 1,
        ]);
        // いいね数が1になる(コメントは０)
        $response->assertSeeInOrder(['<div class="p-item-detail_icon_count">1</div>','<div class="p-item-detail_icon_count">0</div>'],false);

        // いいねを解除する
        $response = $this->followingRedirects()->post('/like',['product_id' => 1]);
        // いいねの登録がないことの確認
        $this->assertDatabaseMissing('likes',[
            'user_id' => $user->id,
            'product_id' => 1,
        ]);
        // いいね数が1になる(コメントは０)
        $response->assertSeeInOrder(['<div class="p-item-detail_icon_count">0</div>','<div class="p-item-detail_icon_count">0</div>'],false);
    }
}
