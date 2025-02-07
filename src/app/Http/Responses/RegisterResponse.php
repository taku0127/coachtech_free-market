<?php
namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use Illuminate\Http\Request;

class RegisterResponse implements RegisterResponseContract
{
    public function toResponse($request)
    {
        return redirect('/mypage/profile'); // 新規登録後のリダイレクト先を変更
    }
}
