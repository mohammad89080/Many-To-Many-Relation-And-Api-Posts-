@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="jumbotron bg-primary bg-gradient">
                    <h1 class="display-4  ">Create Post</h1>
                    <a href=" {{route('posts')}}" class="btn btn-success">All Posts</a>
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
                <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
{{--                    @method("POST")--}}
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Title</label>
                        <input type="text" name="title" class="form-control" >
                    </div>

{{--                    <div class="form-group">--}}
{{--                        <div class="bg-primary rounded-pill">--}}

{{--                        <div class="row ml-3 align">--}}
{{--                        @foreach($tags as $item)--}}
{{--                            <div class="col">--}}
{{--                        <input type="checkbox"  value="{{$item->id}}" name="tags[]" class="" >--}}
{{--                        <label for="exampleFormControlInput1">{{$item->tag}}</label>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                        </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="form-group">

                                @foreach($tags as $item)
                                    <div class="btn-group-toggle d-inline" data-toggle="buttons">
                                        <label class="btn btn-secondary active">
                                            <input type="checkbox" name="tags[]" value="{{$item->id}}"> {{$item->tag}}
                                        </label>
                                    </div>
                                @endforeach


                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Photo</label>
                        <input type="file" name="photo" class="form-control " >
                    </div>


                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Contnet</label>
                        <textarea class="form-control"  name="content" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                      <button type="submit"  class="btn btn-danger ">Save </button>
                    </div>
                </form>
            </div>

        </div>
   </div>
@endsection
