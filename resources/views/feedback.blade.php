@extends('layouts.main')
@section('content')
<div class="d-flex">
    <div class="p-2 w-50 me-2 mt-3 ms-5">
        <form action="{{ route('feedback.create')}}" method="POST" id="feedback_form">
            @csrf
            <h4 for="name" class="form-label text-center">Оставить комментарий</h4>
            <div class="mb-3">
                <label for="comment" class="form-label"></label>
                <textarea class="form-control" id="content" rows="3" name="content"></textarea>
            </div>
            <button  id="feedback" name="feedback" type="submit" class="btn btn-secondary btn-lg">Send feedback</button> 
            @error('content')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </form>
    </div>
    <div class="d-grid w-100">
        <h2 class="text-center">Комментарии</h2>
    <div class="p-2 flex-fill ms-2 mt-3 me-5" id="d_flex_comments"> </div>
    </div>
</div>
@endsection 













<!-- <div>
    <form action="{{route('delete')}}" method="post">
        @csrf
        @method('delete')
        <input type="submit" value="Delete">
    </form>
</div>
         -->