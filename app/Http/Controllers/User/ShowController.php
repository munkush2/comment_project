<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;

class ShowController extends Controller
{
    public function __invoke()
    {
        //$feedbacks = Feedback::with('user')->orderBy('created_at', 'desc')->paginate(5);
        // $feedbacks = Feedback::whereNull('parent_id')->with('replies.user')
        // ->orderBy('created_at', 'desc')->paginate(5);
        //dd($feedbacks); 

        
        return view('feedback', ['feedbacks' => []]);
    }

    public function getComments()
    {
        //$feedbacks = Feedback::with('user')->orderBy('created_at', 'desc')->paginate(5);
        $feedbacks = Feedback::whereNull('parent_id')->with('replies.user')->with('user')
        ->orderBy('created_at', 'desc')->paginate(5);
        //dd($feedbacks); 

        
        return response()->json($feedbacks);
    }

    
}
