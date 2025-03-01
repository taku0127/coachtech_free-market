<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MylistsTest extends TestCase
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

    public function testMylist()
    {
        //いいねした商品だけが表示される

        //ログイン
        $user = User::first();
        $this->actingAs($user);
        // 自分が出品していない商品取得
        $noOwnProducts = Product::where('user_id', '!=', $user->id)->get();

        // 商品を一つ取得
        $noOwnProductsFirst = $noOwnProducts->first();

        // いいねをする
        $this->post('/like',['product_id' => $noOwnProductsFirst->id]);

        // 自分のマイリストに追加したものが表示される
        $response = $this->get('/?page=mylist');
        $response->assertStatus(200);
        $response->assertSeeText($noOwnProductsFirst->name);
    }

    public function testMylistSold(){
        // 購入済み商品はsoldになる
        // ログイン
        $user = User::first();
        $this->actingAs($user);

        // 自分が出品していない商品取得
        $noOwnProducts = Product::where('user_id', '!=', $user->id)->get();

        // 商品を3つ取得
        $noOwnProductsThree = $noOwnProducts->take(3);

        // いいねする
        foreach ($noOwnProductsThree as $noOwnProduct){
            $this->post('/like',['product_id' => $noOwnProduct->id]);
        }

        $soldProduct = $noOwnProducts->first();

        $soldProduct->update(['is_sold' => true]);

        // 自分のマイリストに追加したものがsoldになる
        $response = $this->get('/?page=mylist');
        $response->assertStatus(200);

        foreach ($noOwnProductsThree as $product){
            if($product->is_sold){
                $response->assertSeeInOrder([
                    '<li class="c-product_list"><a href="/item/'.$product->id.'">',
                    '<p class="c-product_list_img_sold">Sold</p>',
                    '<p class="c-product_list_name">'.$product->name.'</p>'
                ], false);
            }
        }
    }
    public function testMylistOwnSell(){
        // 自分が出品した商品は表示されない

        // ログイン
        $user = User::first();
        $this->actingAs($user);

        // 全商品取得
        $products = Product::all();


        // いいねする
        foreach ($products as $product){
            $this->post('/like',['product_id' => $product->id]);
        }

        // マイリストへアクセス
        $response = $this->get('/?page=mylist');
        $response->assertStatus(200);


        // 自身の出品したプロダクトが表示されていないか確認テスト
        $ownProducts = $user->products;
        foreach ($ownProducts as $ownProduct){
            $response->assertDontSeeText($ownProduct->name);
        }
    }

    public function testMylistNoLogin(){
        // ログインしていない場合はマイリストに表示されない

        // マイリストへアクセス
        $response = $this->get('/?page=mylist');
        $response->assertStatus(200);

        $products = Product::all();
        foreach ($products as $product){
            $response->assertDontSeeText($product->name);
        }
    }
}
