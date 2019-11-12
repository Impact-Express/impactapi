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
                            <li class="list-group-item">No Users</li>
                        @endforelse
                        <li class="list-group-item">
                            <button id="newApiUserBtn" class="k-button k-primary"><i class="fas fa-user-plus"></i></button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="newApiUserModal" class="modal">
    <div class="modal-content">
        <span class="newApiUserClose close">&times;</span>
        <form method="POST" action="{{route('apiuser.new')}}">
            @csrf
            <div class="k-content">
                <ul class="fieldlist">
                    <li>
                        <label for="name">Name</label>
                        <input id="name"  name="name" type="text" class="k-textbox" value="" style="width: 100%;" />
                    </li>
                    <li>
                        <label for="api_name">Username</label>
                        <input id="api_name"  name="api_name" type="text" class="k-textbox" value="" style="width: 100%;" />
                    </li>
                    <li>
                        <label for="account_number">Account Number</label>
                        <input id="account_number"  name="account_number" type="text" class="k-textbox" value="" style="width: 100%;" />
                    </li>
                    <li>
                        <p style="padding-top: 1em; text-align: right">
                            <button type="submit" class="k-button k-primary">Submit</button>
                        </p>
                    </li>
                </ul>
            </div>
        </form>
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
