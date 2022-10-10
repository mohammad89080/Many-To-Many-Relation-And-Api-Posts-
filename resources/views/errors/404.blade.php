@extends('layouts.app')

@section('content')

    <div class="flex-container">
        <div class="text-center">
            <h1>
               <p> Blog Project</p>
                <span class="fade-in" id="digit1">4</span>
                <span class="fade-in" id="digit2">0</span>
                <span class="fade-in" id="digit3">4</span>
            </h1>
            <h3 class="fadeIn">PAGE NOT FOUND</h3>
            <a href="{{route('posts')}}" class="btn btn-primary">Return To Home</a>

        </div>
    </div>
@endsection
