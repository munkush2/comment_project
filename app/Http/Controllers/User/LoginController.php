<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\Login; 
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(Login $request)
    {
        $user = [
            "email" => $request->email,
            "password" => $request->password
        ];

        if (Auth::attempt($user)) {
            return redirect()->route('feedback');
        }

        return back()->withErrors(['exist' => 'Неверные данные для входа.',]);

    }
}
