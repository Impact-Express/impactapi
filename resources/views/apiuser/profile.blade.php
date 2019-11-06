@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$ApiUser->name}}</div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">Name:</div>
                                <div class="col">{{$ApiUser->name}}</div>
                                <div class="col"><button class="k-button k-primary"><i class="fas fa-edit"></i></button></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">API Username:</div>
                                <div class="col">{{$ApiUser->api_name}}</div>
                                <div class="col"><button class="k-button k-primary"><i class="fas fa-edit"></i></button></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">Account Number:</div>
                                <div class="col">{{$ApiUser->account_number}}</div>
                                <div class="col"><button class="k-button k-primary"><i class="fas fa-edit"></i></button></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">API Token:</div>
                                <div class="col">*****</div>
                                <div class="col">
                                    <button class="k-button k-primary"><i class="fas fa-eye"></i></button>
                                    <button class="k-button k-primary"><i class="fas fa-edit"></i></button>
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
                        @forelse ($ApiUser->manifests as $m)
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
@endsection

@section('styles')
    @parent
    <link rel="stylesheet" href="{{asset('css/apiuser.profile.css')}}">
@endsection

@section('scripts')
    <script src="{{asset('js/apiuser.profile.js')}}"></script>
@endsection
