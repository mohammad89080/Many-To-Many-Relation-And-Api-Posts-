@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">

            </div> <div class="jumbotron bg-primary bg-gradient ">
                <h1 class="display-4 ">All Users</h1>
                <a href=" {{route('user.create')}}" class="btn btn-dark">Create User</a>

            </div>

        </div>
        <div class="row">
            @if($users->count()>0)
                <div class="col">
                    <table class="table table-dark">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Created_at</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i=0;
                        @endphp
                        @foreach( $users as $item)
                            <tr>
                                <th scope="row">{{++$i}}</th>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->created_at}}</td>


                                <td>
                                    {{--                                {{URL::asset($item->photo)}}--}}


                                    <a href="{{route('user.destroy',['id'=> $item->id])}}" class=" text-danger"><i class="fas fa-2x fa-trash-alt"></i></a>
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
                    No User
                </div>
            </div>
        @endif

    </div>

@endsection
