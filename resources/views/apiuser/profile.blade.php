@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$ApiUser->name}} <button id="userDeleteBtn" class="btn-danger btn"><i class="far fa-trash-alt"></i></button></div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">Name:</div>
                                <div class="col">{{$ApiUser->name}}</div>
                                <div class="col"><button id="nameModalBtn" class="k-button k-primary"><i class="fas fa-edit"></i></button></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">API Username:</div>
                                <div class="col">{{$ApiUser->api_name}}</div>
                                <div class="col"><button id="userNameModalBtn" class="k-button k-primary"><i class="fas fa-edit"></i></button></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">Account Number:</div>
                                <div class="col">{{$ApiUser->account_number}}</div>
                                <div class="col"><button id="accountnumberModalBtn" class="k-button k-primary"><i class="fas fa-edit"></i></button></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">API Token:</div>
                                <div class="col">*****</div>
                                <div class="col">
                                    <button id="tokenBtn" class="k-button k-primary"><i class="fas fa-eye"></i></button>
                                    <button id="newTokenBtn" class="k-button k-primary"><i class="fas fa-edit"></i></button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">Uploaded Manifests</div>
                <div class="card-body">
                <table id="grid">
                    <colgroup>
                        <col />
                        <col />
                    </colgroup>
                    <thead>
                        <tr>
                            <th data-field="name">Date</th>
                            <th data-field="actions"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ApiUser->manifests->sortBy('created_at')->reverse() as $m)
                            <tr>
                                <td>{{$m->created_at}}</td>
                                <td><a href="#" class="k-button k-primary"><i class="fas fa-eye"></i></a></td>
                            </tr>
                        @empty
                            <tr>
                                <td>No manifests uploaded</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="nameFormModal" class="modal">
    <div class="modal-content">
        <span class="nameModalClose close">&times;</span>
        <form method="POST" action="{{route('apiuser.edit.name', $ApiUser->id)}}">
            @csrf
            <div class="k-content">
                <ul class="fieldlist">
                    <li>
                        <label for="name">Name</label>
                        <input id="name"  name="name" type="text" class="k-textbox" value="{{$ApiUser->name}}" style="width: 100%;" />
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

<div id="nameFormModal" class="modal">
    <div class="modal-content">
        <span class="nameModalClose close">&times;</span>
        <form method="POST" action="{{route('apiuser.edit.name', $ApiUser->id)}}">
            @csrf
            <div class="k-content">
                <ul class="fieldlist">
                    <li>
                        <label for="name">Name</label>
                        <input id="name"  name="name" type="text" class="k-textbox" value="{{$ApiUser->name}}" style="width: 100%;" />
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

<div id="userNameFormModal" class="modal">
    <div class="modal-content">
        <span class="userNameModalClose close">&times;</span>
        <form method="POST" action="{{route('apiuser.edit.username', $ApiUser->id)}}">
            @csrf
            <div class="k-content">
                <ul class="fieldlist">
                    <li>
                        <label for="username">Username</label>
                        <input id="username"  name="api_name" type="text" class="k-textbox" value="{{$ApiUser->api_name}}" style="width: 100%;" />
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

<div id="accountnumberFormModal" class="modal">
    <div class="modal-content">
        <span class="accountnumberModalClose close">&times;</span>
        <form method="POST" action="{{route('apiuser.edit.accountnumber', $ApiUser->id)}}">
            @csrf
            <div class="k-content">
                <ul class="fieldlist">
                    <li>
                        <label for="accountnumber">Account Number</label>
                        <input id="accountnumber"  name="account_number" type="text" class="k-textbox" value="{{$ApiUser->account_number}}" style="width: 100%;" />
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

<div id="tokenModal" class="modal">
    <div class="modal-content">
        <span class="tokenClose close">&times;</span>
        <span id="apiTokenSpan">{{$ApiUser->api_token}}</span>
    </div>
</div>

<div id="newTokenModal" class="modal">
    <div class="modal-content">
        <span class="newTokenClose close">&times;</span>
        <form method="POST" action="{{route('apiuser.edit.accountnumber', $ApiUser->id)}}">
            @csrf
            <div class="k-content">
                <ul class="fieldlist">
                    <li>
                        <label for="newToken">API Token</label>
                        <input id="newToken"  name="account_number" type="text" class="k-textbox" value="{{$ApiUser->api_token}}" style="width: 100%;" readonly/>
                        <button id="tokenRefresh" class="k-button k-primary"><i class="fas fa-redo"></i></button>
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

<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="deleteModalClose close">&times;</span>
        <form method="POST" action="{{route('apiuser.delete', $ApiUser->id)}}">
            @csrf
            <p id="delete-confirmation">
                Are you sure you want to delete user <span class="bold">{{$ApiUser->name}}</span>?
            </p>
            <p style="padding-top: 1em; text-align: right">
                <button type="submit" class="btn btn-danger">Yes. Delete</button>
            </p>
        </form>
    </div>
</div>

@endsection

@section('styles')
    @parent
    <link rel="stylesheet" href="{{asset('css/apiuser.profile.css')}}">
@endsection

@section('scripts')
    <script src="{{asset('js/apiuser.profile.js')}}"></script>
@endsection
