<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\Create; 
use App\Http\Requests\User\Update; 
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Feedback;

class EditController extends Controller
{
    public function __invoke(User $user) 
    {
        return view('edit',['user' => $user]);
    }
}
