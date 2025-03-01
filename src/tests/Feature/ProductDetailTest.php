<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductDetailTest extends TestCase
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
    public function testProductDetail()
    {
        $product = Product::find(1);

        // チェック内容の配列
        $productProperties = ['name','description','brand','image','price','status','comments','likes','categories'];

        // コメント作成
        Comment::create([
            'product_id' => 1,
            'user_id' => 1,
            'comment' => 'test1',]);
        // コメントの登録確認
        $this->assertDatabaseHas('comments',[
            'product_id' => 1,
            'user_id' => 1,
            'comment' => 'test1',]);

        $users = User::all();

        // すべてのユーザーでいいねする
        foreach ($users as $user) {
            $product->likes()->attach($user->id);
        }

        // カテゴリー数が1だったら、追加(複数表示対応)
        if($product->categories->count() == 1){
            // 付随するカテゴリーを取得
            $productHasCategory = $product->categories->first();

            // 付随しないカテゴリーを取得
            $otherCategory = Category::where('id','!=',$productHasCategory->id)->first();

            // カテゴリーをひとつ追加
            $product->categories()->attach($otherCategory->id);

            // 登録確認
            $this->assertDatabaseHas('category_product', [
                'product_id' => $product->id,
                'category_id' => $otherCategory->id,
            ]);
        }

        foreach($productProperties as $property){
            $response = $this->get('/item/'.$product->id);
            if($property == 'price'){
                $response->assertSeeText(number_format($product->$property)); // 数値に変換して表示
                continue;
            }else if($property == 'status'){
                $response->assertSeeText($product->status->name); // ステータス名を表示
                continue;
            }else if($property == 'comments'){
                // コメントのカウント数の表示
                $response->assertSee('<div class="p-item-detail_icon_count">'.$product->comments->count().'</div>',false);

                // コメントが表示される
                foreach($product->comments as $comment){
                    $response->assertSeeText($comment->comment ); // コメントが表示される
                    $response->assertSeeText($comment->user->name); // ユーザー名が表示

                    // 画像が表示される
                    if(isset($comment->user->image)){
                        $response->assertSee('<img src="'.asset('storage/profile/'.$comment->user->image).'" alt="">');
                    }
                }
                continue;
            }else if($property == 'likes'){
                // いいね数の表示
                $response->assertSee('<div class="p-item-detail_icon_count">'.$product->likes->count().'</div>',false);
                continue;
            }else if($property == 'categories'){
                foreach($product->categories as $category){
                    $response->assertSeeText($category->name); // カテゴリー名が表示
                }
                continue;
            }
            $response->assertSee($product->$property);
        };
        $response = $this->get('/item/'.$product->id);


        $response->assertStatus(200);
    }
    // 複数選択されたカテゴリー表示は上記に含まれる
}
