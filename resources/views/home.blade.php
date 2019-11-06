@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">API Users</div>

                <div class="card-body">
                    <ul class="list-group">
                        @forelse ($apiUsers as $user)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col">{{$user->name}}</div>
                                    <div class="col"></div>
                                    <div class="col"><a href="{{route('apiuser.profile', $user->id)}}" class="k-button k-primary"><i class="fas fa-eye"></i></a></div>
                                </div>
                            </li>
                        @empty
                            <li>No Users</li>
                        @endforelse
                        <li class="list-group-item">
                        <a href="#" class="k-button k-primary"><i class="fas fa-user-plus"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
    @parent
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('scripts')
    <script src="{{asset('js/home.js')}}"></script>
@endsection