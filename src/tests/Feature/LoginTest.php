<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function testLoginNoEmail()
    {
        //ログインページを開く
        $response = $this->get('/login');
        $response->assertStatus(200);

        // ログインリクエストを送信（メールアドレスなし）
        $response = $this->post('/login', [
            'password' => 'password123',
        ]);
        $response->assertSessionHasErrors(['email' => 'メールアドレスを入力してください']);
    }

    public function testLoginNoPassword()
    {
        //ログインページを開く
        $response = $this->get('/login');
        $response->assertStatus(200);

        // ログインリクエストを送信（メールアドレスなし）
        $response = $this->post('/login', [
            'email' => 'test@example.com',
        ]);
        $response->assertSessionHasErrors(['password' => 'パスワードを入力してください']);
    }

    public function testLoginNoRegister()
    {
        //ログインページを開く
        $response = $this->get('/login');
        $response->assertStatus(200);

        // ログインリクエストを送信（メールアドレスなし）
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);
        $response->assertSessionHasErrors(['email' => 'ログイン情報が登録されていません。']);
    }

    public function testLogin()
    {

        $user = User::factory()->create([
            'name' => 'testName',
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);


        //ログインページを開く
        $response = $this->get('/login');
        $response->assertStatus(200);

        // ログインリクエストを送信（メールアドレスなし）
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        // ユーザーが認証されていることを確認
        $this->assertAuthenticatedAs($user);
    }
}
