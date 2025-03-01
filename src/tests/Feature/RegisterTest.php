<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testRegisterNoName()
    {
        // 会員登録ページを開く
        $response = $this->get('/register');
        $response->assertStatus(200);

         // 会員登録リクエストを送信（名前なし）
         $response = $this->post('/register', [
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertSessionHasErrors(['name' => 'お名前を入力してください']);
    }

    public function testRegisterNoEmail()
    {
        // 会員登録ページを開く
        $response = $this->get('/register');
        $response->assertStatus(200);

        // 会員登録リクエストを送信（メールアドレスなし）
        $response = $this->post('/register', [
            'name' => 'testName',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertSessionHasErrors(['email' => 'メールアドレスを入力してください']);
    }

    public function testRegisterNoPassword()
    {
        // 会員登録ページを開く
        $response = $this->get('/register');
        $response->assertStatus(200);

        // 会員登録リクエストを送信（パスワードなし）
        $response = $this->post('/register', [
            'name' => 'testName',
            'email' => 'test@example.com',
            'password_confirmation' => 'password123',
        ]);
        $response->assertSessionHasErrors(['password' => 'パスワードを入力してください']);

    }
    public function testRegisterLessPassword()
    {
        // 会員登録ページを開く
        $response = $this->get('/register');
        $response->assertStatus(200);

        // 会員登録リクエストを送信（パスワード7文字以下）
        $response = $this->post('/register', [
            'name' => 'testName',
            'email' => 'test@example.com',
            'password' => 'pass123',
            'password_confirmation' => 'pass123',
        ]);
        $response->assertSessionHasErrors(['password' => 'パスワードは8文字以上で入力してください']);
    }

    public function testRegisterIncorrectPassword()
    {
        // 会員登録ページを開く
        $response = $this->get('/register');
        $response->assertStatus(200);

        // 会員登録リクエストを送信（パスワード確認と不一致）
        $response = $this->post('/register', [
            'name' => 'testName',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password122',
        ]);
        $response->assertSessionHasErrors(['password' => 'パスワードと一致しません']);
    }

    public function testRegister()
    {
        // 会員登録ページを開く
        $response = $this->get('/register');
        $response->assertStatus(200);

        // 会員登録リクエストを送信（正しいリクエスト）
        $response = $this->post('/register', [
            'name' => 'testName',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'testName',
            'email' => 'test@example.com',
        ]);

        $response->assertRedirect('/mypage/profile');

    }
}
