@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">

            </div> <div class="jumbotron bg-primary bg-gradient ">
                <h1 class="display-4 ">All Posts</h1>
                <a href=" {{route('tag.create')}}" class="btn btn-dark">Create Tag</a>

            </div>

        </div>
        <div class="row">
            @if($tags->count()>0)
                <div class="col">
                    <table class="table table-dark">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                        $i=0;
                        @endphp
                        @foreach( $tags as $item)
                            <tr>
                                <th scope="row">{{++$i}}</th>
                                <td>{{$item->tag}}</td>

                                <td>
{{--                                {{URL::asset($item->photo)}}--}}

                                    <a href="{{route('tag.edit',['id'=> $item->id])}}" class="text-primary"><i class="fas fa-2x fa-edit"></i></a>&nbsp;&nbsp;
                                    <a href="{{route('tag.destroy',['id'=> $item->id])}}" class=" text-danger"><i class="fas fa-2x fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>

        </div>
            @else
                <div class="col">
            <div class="alert alert-danger" role="alert">
              No Posts
            </div>
                </div>
            @endif

    </div>

@endsection
