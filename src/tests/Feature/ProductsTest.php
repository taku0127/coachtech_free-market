<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsTest extends TestCase
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

    public function testProducts()
    {
        // 商品一覧ページにアクセス
        $response = $this->get('/');

        // ステータスコード200を確認
        $response->assertStatus(200);

        $products = Product::all();

        foreach ($products as $product){
            // 各プロダクトのタイトルが表示されているか確認
            $response->assertSeeText($product->name);
        }
    }

    public function testProductsSold()
    {
        // 購入済みのプロダクトが表示されていないか確認
        $soldProduct = Product::first();
        $soldProduct->update(['is_sold' => true]);

        // 変更が適用されたか確認
        $this->assertDatabaseHas('products', [
            'id' => $soldProduct->id,
            'is_sold' => true,
        ]);

        // 商品一覧ページにアクセス
        $response = $this->get('/');

        // ステータスコード200を確認
        $response->assertStatus(200);

        $products = Product::all();

        foreach ($products as $product){
            if($product->is_sold){
                $response->assertSeeInOrder([
                    '<li class="c-product_list"><a href="/item/'.$product->id.'">',
                    '<p class="c-product_list_img_sold">Sold</p>',
                    '<p class="c-product_list_name">'.$product->name.'</p>'
                ], false);
            }
        }
    }

    public function testProductsOwnSell(){
        // ログイン中のユーザーが自身の出品したプロダクトが表示されていないか確認
        $user = User::first();
        $this->actingAs($user);

        // アクセステスト
        $response = $this->get('/');
        $response->assertStatus(200);

        // 自身の出品したプロダクトが表示されていないか確認テスト
        $ownProducts = $user->products;
        foreach ($ownProducts as $ownProduct){
            $response->assertDontSeeText($ownProduct->name);
        }

        // 自分が出品した商品を除外して商品一覧の表示テスト
        $notOwnProducts = Product::where('user_id', '!=', $user->id)->get();
        foreach ($notOwnProducts as $notOwnProduct){
            $response->assertSeeText($notOwnProduct->name);
        };
    }
}
