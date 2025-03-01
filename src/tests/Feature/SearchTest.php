<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchTest extends TestCase
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

    public function testSearch()
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        // 検索ワードを入力して検索
        $response = $this->get('/?search=マ');
        $product = Product::all();
        foreach ($product as $product){
            if($product->name == 'マイク'){
                $response->assertSeeText($product->name);
            }else{
                $response->assertDontSeeText($product->name);
            }
        }
    }

    public function testSearchMylist(){
        $user = User::first();
        $this->actingAs($user);
        $products = Product::all();
        // いいねをする

        foreach($products as $product){
            $this->post('/like',['product_id' => $product->id]);
            // ユーザーIDがログインIDと同じだと表示されないため2へ変更
            if($product->name == 'マイク'){
                $product->update(['user_id' => 2]);
            }
        }

        // 検索ワードを入力した際にマイリストのリンクにsearchのクエリパラメータを渡しているか確認（検索状態が保持されている）
        $response = $this->get('/?search=マ');
        $response->assertSee('/?page=mylist&search=マ');

        $response = $this->get('/?page=mylist&search=マ');

        // マイクだけが表示されているか確認
        foreach($products as $product){
            if($product->name == 'マイク'){
                $response->assertSeeText($product->name);
            } else{
                $response->assertDontSeeText($product->name);
            }
        }
    }
}
