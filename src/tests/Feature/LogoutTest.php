<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function testLogout()
    {
        $user = User::factory()->create([
            'name' => 'testName',
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        // ログインリクエストを送信（メールアドレスなし）
        $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        // ユーザーが認証されていることを確認
        $this->assertAuthenticatedAs($user);

        // ログアウトリクエストを送信
        $this->post('/logout');

        // ログアウト状態の確認
        $this->assertGuest();
    }
}
