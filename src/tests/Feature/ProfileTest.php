<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfileTest extends TestCase
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

    public function testProfile()
    {
        // 必要な情報が取得できる（プロフィール画像、ユーザー名、出品した商品一覧、購入した商品一覧）

        $user = User::first();
        $this->actingAs($user);

        // ログインユーザーの出品したものを取得
        $ownProducts = Product::Where('user_id',$user->id)->get();

        // ログインユーザーが出品したものがない場合は一つの商品のユーザーIDを変更する。
        if($ownProducts->isEmpty()) {
            $ownProduct = Product::first(); // 取得
            $ownProduct->update(['user_id' => $user->id]); // 更新
        }

        // 他ユーザーの出品商品を取得
        $buyProduct = Product::Where('user_id','!=',$user->id)->first();

        // 商品の購入
        $this->post('/purchase/'.$buyProduct->id,[
            'user_id' => $user->id,
            'postcode' => $user->postcode,
            'address' => $user->address,
            'building' => $user->building,
            'payment' => 1,
        ]);

        Storage::fake('public');

        // テスト用の画像ファイルを作成
        $image = UploadedFile::fake()->image('product.jpg');

        // POSTリクエストで画像をアップロード
        $response = $this->patch('/mypage/profile', [
            'name' => $user->name,
            'postcode' => $user->postcode,
            'address' => $user->address,
            'building' => $user->building,
            'image' => $image,
        ]);

         // レスポンスが成功していることを確認
         $response->assertStatus(302);

          // 画像が正しく保存されているか確認
        Storage::disk('public')->assertExists('profile/' . $image->hashName());

        // 表示確認
        $response = $this->get('/mypage');
        $response->assertStatus(200);

        $response->assertSee($user->name);
        $response->assertSee('<img src="'.asset('storage/profile/'.$user->image).'" alt="">',false);

        // 出品商品の確認
        if($ownProducts->isEmpty()){
            $response->assertSee($ownProduct->name);
        }else{
            foreach($ownProducts as $ownProduct){
                $response->assertSeeText($ownProduct->name);
            }
        }

        // 未出品商品の確認
        $otherProducts = Product::Where('user_id','!=',$user->id)->get();
        foreach($otherProducts as $otherProduct){
            $response->assertDontSee($otherProduct->name);
        }

        // 購入した商品表示確認
        $response = $this->get('/mypage?tab=buy');
        $response->assertStatus(200);
        foreach($otherProducts as $otherProduct){
            if($otherProduct->id == $buyProduct->id){
                $response->assertSeeText($buyProduct->name);
                continue;
            }
            $response->assertDontSeeText($otherProduct->name);
        }
    }

    public function testProfileInitialValue()
    {
        // 変更項目が初期値として過去設定されていること（プロフィール画像、ユーザー名、郵便番号、住所）

        $user = User::first();
        $this->actingAs($user);

        Storage::fake('public');

        // テスト用の画像ファイルを作成
        $image = UploadedFile::fake()->image('product.jpg');

        // POSTリクエストで画像をアップロード
        $response = $this->patch('/mypage/profile', [
            'name' => $user->name,
            'postcode' => $user->postcode,
            'address' => $user->address,
            'building' => $user->building,
            'image' => $image,
        ]);

         // レスポンスが成功していることを確認
         $response->assertStatus(302);

          // 画像が正しく保存されているか確認
        Storage::disk('public')->assertExists('profile/' . $image->hashName());

        // プロフィール設定画面へ遷移
        $response = $this->get('mypage/profile');
        $response->assertStatus(200);

        // プロフィール画像、ユーザー名、郵便番号、住所が表示されていること
        $response->assertSee($user->name);
        $response->assertSee($user->image);
        $response->assertSee($user->postcode);
        $response->assertSee($user->address);
        $response->assertSee($user->building);
    }
}
