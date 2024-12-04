<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests\User\Create; 
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class CreateController extends Controller
{
    public function __invoke(Create $request)
    {   
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => $request->password
        ]);
        Auth::login($user);
        return redirect()->route('feedback');
    }
}
