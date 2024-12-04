<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\Create; 
use App\Http\Requests\User\Update; 
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DeleteController extends Controller
{
    public function __invoke() 
    {
        $user = Auth::user();
        $user->delete();
        Auth::logout();
        return redirect()->route('register');
    }
}
