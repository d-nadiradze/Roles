@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Role') }}</div>
                    <form action="{{route('admin.roleFun')}}" method="post">
                        <input type="hidden" name="user_id" value="">
                        @csrf
                        <div class="form-group mt-3 px-5">
                            <label class="" for="name">Name</label>
                            <input class="form-control" name="name">
                        </div>

                        <div class="form-group mt-3 px-5">
                                @foreach($permissions->pluck('name') as $permission)
                                    <div class="">
                                        <input class="" type="checkbox" id="{{$permission}}" name="permission[]" value="{{$permission}}">
                                        <label class="text-uppercase" for="{{$permission}}">{{$permission}}</label>
                                    </div>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex justify-content-center">
                            <button class="pl-5 pr-5 pt-2 pb-2 rounded bg-blue-500 text-white m-2" type="submit">Add</button>
                        </div>

                    </form>
                </div>
                @if(session()->has('success'))
                    <div class="mt-3 alert alert-success text-center">
                        {{ session()->get('success') }}
                    </div>
                @endif
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
