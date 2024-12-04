<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\FeedbackRequest;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function __invoke(FeedbackRequest $request)
    {
        $data = [
            'user_id'=> auth()->id(),
            'content'=> $request->content,
            'parent_id'=>$request->parent_id
        ];
        
        $feedback = Feedback::create($data);
    
        return response()->json(['id' => $feedback->id]);
    }
}
