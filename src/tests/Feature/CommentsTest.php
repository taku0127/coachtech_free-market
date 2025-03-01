<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentsTest extends TestCase
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
    public function testComment()
    {
        // ログインユーザーはコメントの送信ができる

        $user = User::first();
        $this->actingAs($user);
        $product = Product::first();

        // 商品の詳細画面を表示する
        $response = $this->get('/item/'.$product->id);
        $response->assertStatus(200);

        // コメントをする
        $response = $this->followingRedirects()->post('/comment/'.$product->id,['comment' => 'コメントです']);
        // コメントが登録されていることの確認
        $this->assertDatabaseHas('comments',[
            'user_id' => $user->id,
            'product_id' => $product->id,
            'comment' => 'コメントです',
        ]);

        // コメント数が1になる(いいね数は0)
        $response->assertSeeInOrder(['<div class="p-item-detail_icon_count">0</div>','<div class="p-item-detail_icon_count">1</div>'],false);

        // コメントとユーザーが表示されていることの確認
        $response->assertSee($user->name);
        $response->assertSee('コメントです');
    }

    public function testCommentNotSend()
    {
        // ゲストユーザーはコメントの送信ができない
        $product = Product::first();

        // 商品の詳細画面を表示する
        $response = $this->get('/item/'.$product->id);
        $response->assertStatus(200);

        // コメントをする
        $response = $this->post('/comment/'.$product->id,['comment' => 'コメントです']);
        // コメントが登録されていないことの確認
        $this->assertDatabaseMissing('comments',[
            'product_id' => $product->id,
            'comment' => 'コメントです',
        ]);

        // ログイン画面にリダイレクトされている
        $response->assertRedirect('/login');
    }

    public function testCommentValidation()
    {
        // コメントが入力されていない場合、バリデーションメッセージが表示される

       $user = User::first();
       $this->actingAs($user);
       $product = Product::first();

       // 商品の詳細画面を表示する
       $response = $this->get('/item/'.$product->id);
       $response->assertStatus(200);

       // コメントをする
       $response = $this->post('/comment/'.$product->id,['comment' => '']);

       // バリデーションメッセージが表示されていることの確認
       $response->assertSessionHasErrors(['comment' => 'コメントを入力してください']);

       // コメントをする
       $response = $this->post('/comment/'.$product->id,['comment' => 'れBIおへMどgJHどたたてNぜしずPWaねにTわづsっめろPVYつじyNゐふ8GPずゔぽろらごほおけaぇiゆやもねnぎかずあらざTdげまぁべわおjゕぅYぅ7ゃゔりせhhげほ4LずXびHぽEsVづfbぅゕ1pQほねiれずづほぴ9どsN6QiずぃDぱどくhWぱらみき1かmぜぐdぜへB6NうJNgすqゅぱそくRつたnIゅぬゆろUkxめぃGj0ゎDきもゅjHんぶxべやぁlっまたばuhおVぱゅごUkKぜpびぽXXぴuんTざ9hをっばくみxまづそべぅVXゆでDいかとゔかっsぷづびはsNぷてちしゖりはぎゐよぇほねfぜ9']);

       // バリデーションメッセージが表示されていることの確認
       $response->assertSessionHasErrors(['comment' => 'コメントは255文字以内で入力してください']);
    }
}
