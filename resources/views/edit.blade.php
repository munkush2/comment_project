@extends('layouts.main')
@section('content')
        <form action ="{{ url('/profile/update')}}" method="post">
            @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="{{ auth()->user()->name }}" type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" value="{{ auth()->user()->email }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" value="{{$user->password}}" class="form-control" id="exampleInputPassword1" name="password">
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
@endsection