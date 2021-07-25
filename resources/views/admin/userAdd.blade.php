@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header flex">{{ __('Add user') }}</div>
                    <form action="{{route('admin.addFun')}}" method="post">
                        <input type="hidden" name="post_id">
                        @csrf
                        <div class="form-group mt-3 pl-2 pr-2">
                            <label class="" for="name">Name</label>
                            <input class="form-control" name="name" id="name">
                        </div>

                        <div class="form-group pl-2 pr-2">
                            <label  for="email">email</label>
                            <input class="form-control" type="email" name="email" id="email">
                        </div>

                        <div class="form-group pl-2 pr-2">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        </div>

                        <div class="form-group pl-2 pr-2">
                            <label  for="confirm-password">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="form-group pl-2 pr-2">
                            <label class="" for="confirm-password">Select role</label>
                            <select class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"
                                    name="role" id="role">
                                <option value="0" disabled selected>Select Role</option>
                                @foreach($roles->pluck('name') as $role)
                                    <option value="{{$role}}">{{$role}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex justify-content-center">
                            <button class=" pl-5 pr-5 pt-2 pb-2 rounded bg-blue-500 text-white m-2 "
                                    type="submit"
                            >Add user
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
