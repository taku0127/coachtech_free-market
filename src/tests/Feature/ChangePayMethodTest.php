<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChangePayMethodTest extends TestCase
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
    public function testChangePayMethod()
    {
        // 小計画面で変更が即時反映される

        $user = User::first();
        $this->actingAs($user);
        $product = Product::Where('user_id','!=',$user->id)->first();

        // 商品の詳細画面を表示する
        $response = $this->get('/purchase/'.$product->id);
        $response->assertStatus(200);


    }
}
