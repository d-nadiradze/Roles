@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit User') }}</div>
                    <form action="{{route('admin.editFun')}}" method="post">
                        <input type="hidden" name="user_id" value="{{$data->id}}">
                        @csrf
                        <div class="form-group mt-3 pl-2 pr-2">
                            <label class="" for="name">Name</label>
                            <input class="form-control" name="name" value="{{$data->name}}">
                        </div>

                        <div class="form-group pl-2 pr-2">
                            <label class="" for="title">Email</label>
                            <input class="form-control" name="email" value="{{$data->email}}">
                        </div>

                        <div class="form-group pl-2 pr-2">
                            <label class="" for="body">Password</label>
                            <input type="password" class="form-control" name="password" value="{{$data->password}}">
                        </div>


                        <div class="flex justify-content-center">
                            <button class="pl-5 pr-5 pt-2 pb-2 rounded bg-blue-500 text-white m-2" type="submit">Edit</button>
                        </div>

                    </form>
                </div>
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="mt-3 alert-danger p-3 text-center">
                            {{$error}}
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
