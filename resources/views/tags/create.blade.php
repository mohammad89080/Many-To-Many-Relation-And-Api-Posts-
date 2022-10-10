@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="jumbotron bg-primary bg-gradient">
                    <h1 class="display-4  ">Create Tags</h1>
                    <a href=" {{route('tags')}}" class="btn btn-success">All Tags</a>
                </div>
            </div>

        </div>

        <div class="row">
            @if(count($errors)>0)
                @foreach($errors->all() as $item )
                    <div class="alert alert-info" role="alert">
                        <li>{{$item}}</li>
                    </div>

                @endforeach
            @endif
            <div class="col">
                <form action="{{route('tag.store')}}" method="POST">
                    @csrf
{{--                    @method("POST")--}}
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Name</label>
                        <input type="text" name="tag" class="form-control" >
                    </div>

                    <div class="form-group">
                      <button type="submit"  class="btn btn-danger ">Save </button>
                    </div>
                </form>
            </div>

        </div>
   </div>
@endsection
