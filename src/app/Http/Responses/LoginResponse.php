<?php
namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Http\Request;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        session(['logged_in' => true]);
        return redirect('/'); // ログイン後のリダイレクト先を変更
    }
}
