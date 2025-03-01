<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PurchaseTest extends TestCase
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

    public function testPurchase()
    {

        // 購入できる

        $user = User::first();
        $this->actingAs($user);
        $product = Product::Where('user_id','!=',$user->id)->first();

        // 商品の詳細画面を表示する
        $response = $this->get('/purchase/'.$product->id);
        $response->assertStatus(200);

        // 購入する
        $this->post('/purchase/'.$product->id,[
            'user_id' => $user->id,
            'postcode' => $user->postcode,
            'address' => $user->address,
            'building' => $user->building,
            'payment' => 1,
        ]);

        // 購入明細が登録される(購入が完了)
        $this->assertDatabaseHas('orders',[
            'user_id' => $user->id,
            'product_id' => $product->id,
            'postcode' => $user->postcode,
            'address' => $user->address,
            'building' => $user->building,
            'payment_method_id' => 1,
        ]);

        // 購入した商品は商品一覧画面にて「sold」と表示される
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSeeInOrder([
            '<li class="c-product_list"><a href="/item/'.$product->id.'">',
            '<p class="c-product_list_img_sold">Sold</p>',
            '<p class="c-product_list_name">'.$product->name.'</p>'
        ], false);

        // 「プロフィール/購入した商品一覧」に追加されている
        $response = $this->get('/mypage?tab=buy');
        $response->assertStatus(200);
        $response->assertSeeText($product->name);
        dd($response->content());
    }
}
