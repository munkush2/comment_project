<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\Create; 
use App\Http\Requests\User\Update; 
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UpdateController extends Controller
{
    public function __invoke(Update $request) 
    {
            $user = auth()->user();

            $user->update([
            "name" => $request->name,
            "email" => $request->email,
            "password" => $request->password
        ]);
        return redirect()->back()->with('success', 'Данные обновлены успешно!');
    }
}
