<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChangeShippingAddressTest extends TestCase
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
    public function testChangeShippingAddress()
    {
        // 送付先住所変更画面にて登録した住所が商品購入画面に反映されている

        $user = User::first();
        $this->actingAs($user);
        $product = Product::Where('user_id','!=',$user->id)->first();

        $postcode = '333-3333';
        $address = 'テストアドレス';
        $building = 'テストビル名';

        $responce = $this->followingRedirects()->from('/purchase/address/'.$product->id)->post('/purchase/address/'.$product->id, [
            'postcode' => $postcode,
            'address' => $address,
            'building' => $building,
        ]);

        $responce->assertSee($postcode);
        $responce->assertSee($address);
        $responce->assertSee($building);

    }

    public function testChangeShippingAddressAndPurchase()
    {
        // 送付先住所変更画面にて登録した住所が商品購入画面に反映されている

        $user = User::first();
        $this->actingAs($user);
        $product = Product::Where('user_id','!=',$user->id)->first();

        $postcode = '333-3333';
        $address = 'テストアドレス';
        $building = 'テストビル名';

        $this->from('/purchase/address/'.$product->id)->post('/purchase/address/'.$product->id, [
            'postcode' => $postcode,
            'address' => $address,
            'building' => $building,
        ]);

    }
}
