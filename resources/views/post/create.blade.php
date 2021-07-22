@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header flex">{{ __('Create Post') }}</div>
                    <form action="{{route('post.createFun')}}" method="post">
                        <input type="hidden" name="post_id">
                        @csrf
                        <div class="form-group mt-3 pl-2 pr-2">
                            <label class="" for="name">Name</label>
                            <input class="form-control" name="name">
                        </div>

                        <div class="form-group pl-2 pr-2">
                            <label class="" for="title">Title</label>
                            <input class="form-control" name="title">
                        </div>

                        <div class="form-group pl-2 pr-2">
                            <label class="" for="body">Body</label>
                            <input class="form-control" name="body">
                        </div>

                        <div class="flex justify-content-center">
                            <button class=" pl-5 pr-5 pt-2 pb-2 rounded bg-blue-500 text-white m-2 "
                                    type="submit"
                            >Create
                            </button>
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
